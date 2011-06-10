<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">
			
                    <?php
                    $home = $article->listArticle();
                    while ($row = mysql_fetch_array($home['rs'])) {
                        $rowLink = $common->getLink('blog-view', $row['title_link']);
                    ?>
			<div class="col">
				<div class="post">
                                    <h2><a href="<?php echo $rowLink;?>" title="<?php echo $row['title'];?>"><?php echo $row['title'];?></a></h2>
                                    <p>
                                        <?php echo $row['description'];?>
                                    </p>
                                    <div class="cl">&nbsp;</div>
                                    <a href="<?php echo $rowLink;?>" title="<?php echo $row['title'];?>" class="more">Read more</a>
				</div>
			</div>
                    <?php
                    }
                    if ($home["totalPage"] > 1) {
                        echo $common->paging($home["page"], $home["totalPage"],'blog-page');
                    }
                    ?>
		</div>

                <?php
                    $hot = $article->listHotArticle();
                    if($db->num_rows($hot)){
                ?>
		<div id="sidebar">
			<div class="post">
				<h2>Hot articles</h2>
				<ul>
                                <?php
                                while ($row = mysql_fetch_array($hot)) {
                                    $rowLink = $common->getLink('view', $row['title_link']);
                                ?>
                                    <li>
                                        <a href="<?php echo $rowLink;?>" title="<?php echo $row['title'];?>"><?php echo $row['title'];?></a>
                                    </li>
                                <?php
                                    }
                                ?>
                                </ul>

			</div>
		</div>
                <?php
                    }
                ?>
		<div class="cl">&nbsp;</div>
	</div>
</div>
<!-- End Main -->
