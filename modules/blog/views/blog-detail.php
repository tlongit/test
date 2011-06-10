<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">

                <?php
                    $row = $article->detailArticle();
                    $rowLink = $common->getLink('view', $row['title_link']);
                ?>
                <div class="col">
                        <div class="post">
                            <h2><?php echo $row['title'];?></h2>
                            <p>
                                <?php echo $row['content'];?>
                            </p>
                            <div class="cl">&nbsp;</div>
                        </div>
                </div>
                   
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
