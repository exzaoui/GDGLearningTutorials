<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'gdglearning');
include('includes/header.html');
?>

<!--header-->
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            $query = "SELECT * from posts order by p_time desc";
            $result = mysqli_query($connect, $query);
            if ($result) {
                while ($post_info = mysqli_fetch_assoc($result)) {
                    $user_id = $post_info['p_user'];
                    $q = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
                    $r = mysqli_query($connect, $q);
                    if ($r) {
                        $username = mysqli_fetch_assoc($r);
                    }
                    ?>

                    <h2>
                        <a href="#"><?= $post_info['p_title'] ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="#"><?php echo $username['user_name']; ?></a>
                    </p>

                    <p><span class="glyphicon glyphicon-time"></span> <?= $post_info['p_time'] ?>

                    </p>
                    <hr>
                    <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                    <hr>
                    <p style="text-align: justify;"><?= $post_info['p_content'] ?></p>
                    <a href="#" class="btn btn-primary">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>

                    <?php
                }
            } else {
                echo mysqli_error($connect);
            }
            ?>


            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

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
