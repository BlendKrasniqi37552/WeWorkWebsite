<?php

class BlogPost {
  private $connection;
  private $query;
  private $posts;
  public $post;

public function fetchBlogPosts(){
  $this->connection = new DBConnection();
  $this->query = $this->connection->getConnection()->query('SELECT * FROM blog');
  $this->posts = $this->query->fetchAll();
}

public function echoBlogPosts(){

  foreach(array_reverse($this->posts) as $post) {
    $id = $post['id'];
    $posturl = $post['imageurl'];
    $content = $post['entertext'];
    echo "

    <div class='article'>
    <img class='blogimage' src='img/blog/{$posturl}'>
    <h2>{$post['title']}</h2>
    <p>Author: {$post['author']}</p>
    <p>{$content}</p>
    </div>
    ";
}
}

public function echoBlogPostsAdmin(){

  foreach(array_reverse($this->posts) as $post) {
    $id = $post['id'];
    $posturl = $post['imageurl'];
    $content = $post['entertext'];
    echo "

    <div class='article'>
    <img class='blogimage' src='img/blog/{$posturl}'>
    <h2>{$post['title']}</h2>
    <p>Author: {$post['author']}</p>
    <p>{$content}</p>
    <a href='admin-edit_blog.php?id={$id}'><button id='button'>Edit</button></a>
    <a href='admin-delete_blog.php?id={$id}'><button id='button'>Delete</button></a>
    </div>
    ";
}
}

public function fetchPostID(){
  if(isset($_GET['id'])){
      $id = $_GET['id'];
  }

  $this->connection = new DBConnection();

  $sql = 'SELECT * FROM blog WHERE id = :id';
  $query = $this->connection->getConnection()->prepare($sql);
  $query->execute(['id' => $id]);

  $this->post = $query->fetch();
}

public function editBlog(){
  $this->connection = new DBConnection();
  if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $entertext = $_POST['entertext'];
        $id = $_GET['id'];

        $sql = 'UPDATE blog SET title = :title, entertext = :entertext WHERE id = :id ';
        $query = $this->connection->getConnection()->prepare($sql);
        $query->bindParam('title', $title);
        $query->bindParam('entertext', $entertext);
        $query->bindParam('id', $id);

        $query->execute();

        header("Location: admin-blog.php");
    }
}



}
