<?php
class Items extends Db
{
    public function getAllItems()
    {
        $sql = self::$connection->prepare("SELECT * FROM `items`");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getNewItems($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` ORDER BY `created_at` DESC LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getItemById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` WHERE `id`= ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }


    public function getFeaturedItem($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` WHERE `featured`= 1
         ORDER BY `created_at` DESC LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function search($keyword, $start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` WHERE `content` LIKE ? LIMIT ?,?");
        $keyword = "%$keyword%";
        $sql->bind_param("ii", $keyword, $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function searchCount($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` WHERE `content` LIKE ?");
        $keyword = "%$keyword%";
        $sql->bind_param("S", $keyword);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
}
