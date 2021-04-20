<?php

class News
{
    public static function getNewsItemByID($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnect();

            $result = $db->query('SELECT * FROM news WHERE id ='. $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $newsItem = $result->fetch();
            return $newsItem;
        }
    }
    
    public static function getNewsList()
    {
        $db = Db::getConnect();

        $newList = array();

        $result = $db->query('SELECT id, title, date, short_content FROM news ORDER BY date DESC LIMIT 10');

        $i = 0;
        while ($row = $result->fetch()) {
            $newList[$i]['id'] = $row['id'];
            $newList[$i]['title'] = $row['title'];
            $newList[$i]['date'] = $row['date'];
            $newList[$i]['short_content'] = $row['short_content'];
            $i++;
        }
        return $newList;
    }
}