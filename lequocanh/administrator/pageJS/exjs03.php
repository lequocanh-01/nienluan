<div id="content">
    <div id="video-container">
        <video id="video" controls autoplay muted>
            <source src="./img_LQA/YORN.mp4" type="video/mp4">
        </video>
    </div>
</div>
<hr/>
<div id="menu">
    No ajax <br/>
    <a href="index.php?page=page01">Page 01</a> |
    <a href="index.php?page=page02">Page 02</a> |
    <a href="index.php?page=page03">Page 03</a> |
    <a href="index.php?page=page04">Page 04</a>
    <hr/>
    Use ajax <br/>
    <b class="linkmenu" value='page01'>Page 01</b>|
    <b class="linkmenu" value='page02'>Page 02</b>❘
    <b class="linkmenu" value='page03'>Page 03</b>|
    <b class="linkmenu" value='page04'>Page 04</b>
    <hr/>
</div>
<hr/>
<div id="getContent">
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        include './pageJS/' . $page . '.php';
    } else {
        echo "Nothing to show!";
    }
    ?>
</div>
