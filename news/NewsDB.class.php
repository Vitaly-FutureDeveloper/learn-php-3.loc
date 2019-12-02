<?php
function __autoload ($name) {
    require "$name.class.php";
}

class NewsDB implements INewsDB {
    const DB_NAME = "../news.db";
    const RSS_NAME = "rss.xml";
    const RSS_TITLE = "Последние новости";
    const RSS_LINK = "http://learn-php-3.loc/news/news.php";
    protected $_db = NULL;

    function __get ($name) {
        if ($name == "_db")
            return $this->_db;
        throw new Exception("Unknown property");
    }

    function __construct (){

        $this->_db = new SQLite3(self::DB_NAME);

        if( is_file(self::DB_NAME) and filesize(self::DB_NAME) == 0 ){
            try{
                $sql1 = "CREATE TABLE msgs(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    title TEXT,
                    category INTEGER,
                    description TEXT,
                    source TEXT,
                    datetime INTEGER
                )";
                $sql2 = "CREATE TABLE category(
                    id INTEGER,
                    name TEXT
                )";
                $sql3 = "INSERT INTO category(id, name)
                    SELECT 1 as id, 'Политика' as name
                    UNION SELECT 2 as id, 'Культура' as name
                    UNION SELECT 3 as id, 'Спорт' as name";

            $result1 = $this->_db->exec($sql1);
                if(!$this->_db->exec($sql1)){
                    throw new Exception ($this->_db->lastErrorMsg());
                }
            $result2 = $this->_db->exec($sql2);
                if(!$this->_db->exec($sql2)){
                    throw new Exception ($this->_db->lastErrorMsg());
                }
            $result3 = $this->_db->exec($sql3);
                if(!$this->_db->exec($sql3)){
                    throw new Exception ($this->_db->lastErrorMsg());
                }
            }catch(Exception $e){
                $e->getMessage();
                echo "Ошибка Создания БД";
            }
        }
    }

    function saveNews($title, $category, $description, $source){
     /*   public $title; //- заголовок новости
        public $category; //- категория новости
        public $description; //- текст новости
        public $source; //- источник новости
*/
        $dt = time();

        $sql = "INSERT INTO msgs (title, category, description, source, datetime)
                VALUES (:title, :category, :description, :source, :datetime)";
        
        if( !$stmt = $this->_db->prepare($sql) ){
            echo "Ошибка добавления новости в БД";
            return false;
        }

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':source', $source);

        $stmt->bindParam(':datetime', $dt);

        $result = $stmt->execute();
        if(!$result)
            return false;

        $this->createRss();
        return true;

        $stmt->close();
    }

    protected function db2Array ($data) {
        while ( $row = $data->fetchArray(SQLITE3_ASSOC) ) {
            $arr[] = $row;
        }
        return $arr;
    }
    function getNews(){
        $sql = "SELECT msgs.id as id, title, category.name as category,
                    description, source, datetime
                FROM msgs, category
                WHERE category.id = msgs.category
                ORDER BY msgs.id DESC";

        $result = $this->_db->query($sql);
        if (!$result)
            return false;
        return $this->db2Array($result);
    }

    function deleteNews($id){
        $sql = "DELETE FROM msgs WHERE id = $id";

        if (!$result = $this->_db->query($sql))
            return false;

        return true;
    }

    function clearStr($data) {
        $data = strip_tags($data);
        return $this->_db->escapeString($data);
    }
    function clearInt($data) {
        return abs( (int) $data );
    }

    function __destruct() {
        unset($this->_db);
    }

    protected function createRss() {
        $dom = new DOMDocument("1.0", "utf-8");
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;

        $rss = $dom->createElement("rss");
        $dom->appendChild($rss);

        $version = $dom->createAttribute("version");
        $version->value = '2.0';
        $rss->appendChild($version);

        $channel = $dom->createElement("channel");
        $title = $dom->createElement("title", self::RSS_TITLE);
        $link = $dom->createElement("link", self::RSS_LINK);

        $channel->appendChild($title);
        $channel->appendChild($link);
        $rss->appendChild($channel);

        $lenta = $this->getNews();
        if(!$lenta)
            return false;
        foreach($lenta as $news){
            $item = $dom->createElement("item");
            $category = $dom->createElement("category", $news['category']);
            $description = $dom->createElement("description", $news['description']);
            $cdata = $dom->createCDATASection($news['description']);
            $description->appendChild($cdata);

            $link = $dom->createElement("link", "#");

            $date = date("r", $news["datetime"]);
            $pubDate = $dom->createElement("pubDate", $date);

            $item->appendChild($title);
            $item->appendChild($link);
            $item->appendChild($description);
            $item->appendChild($pubDate);
            $item->appendChild($category);

            $channel->appendChild($item);
        }
        $dom->save(self::RSS_NAME);
    }
}

