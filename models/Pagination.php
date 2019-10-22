<?php

class Models_Pagination extends Lmv\writerBlog\Models_DbConnect
{
    public function getPostsPagination()
    {
        $req = $this->_dbConnect()->query('SELECT id FROM posts');
        $totalPosts = $req->rowCount();
        return $totalPosts;
    }
}
