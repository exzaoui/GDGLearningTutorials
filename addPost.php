<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
}
$user_id = $_SESSION['user_id'];
$connect = mysqli_connect('localhost', 'root', '', 'gdglearning');
if (isset($_GET['submitted'])) {
    $title = mysqli_real_escape_string($connect, trim($_GET['title']));
    $content = mysqli_real_escape_string($connect, trim($_GET['content']));
    $query = "INSERT INTO `posts`(`p_title`, `p_content`, `p_time`, `p_user`) VALUES ('$title','$content', now(),$user_id)";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header('location:index.php');
    } else {
        echo mysqli_error($connect);
    }
}

include('includes/header.html');
?>

<!--header-->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-header">
                Add Post
            </h1>
            <form action="addPost.php" method="get">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Post Title" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" placeholder="Post Content" rows="10"
                              required></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="submitted" value="TRUE">
                    <button class="btn btn-primary btn-block">Add Post</button>
                </div>
            </form>
        </div>
        <?php
        include('includes/sidebar.html');
        ?><!-- sidebar-->

    </div>
    <hr>
    <?php
    include('includes/footer.html');
    ?><!-- footer -->
</div>

</body>
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
