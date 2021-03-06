<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="userpanel.php">Home</a> <span class="divider">/</span></li>
            <li><a href="userpanel.php?w=gs"><?php echo $gsprache->gameserver;?></a> <span class="divider">/</span></li>
            <li class="active"><?php echo $sprache->restarttime;?> <span class="divider">/</span></li>
            <li class="active"><?php echo $serverip.":".$port;?></li>
        </ul>
    </div>
</div>
<div class="row-fluid">
<div class="span11">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
    <th><?php echo $sprache->hour;?></th>
    <th><?php echo $sprache->monday;?></th>
    <th><?php echo $sprache->tuesday;?></th>
    <th><?php echo $sprache->wednesday;?></th>
    <th><?php echo $sprache->thursday;?></th>
    <th><?php echo $sprache->friday;?></th>
    <th><?php echo $sprache->saturday;?></th>
    <th><?php echo $sprache->sunday;?></th>
</tr>
</thead>
<tbody>
<?php $i=0; while ($i<24) { ?>
<tr>
    <td><?php if ($i>9) echo $i; else echo "$i";?>:00</td>
    <td>
        <?php if(!empty($restarts[$i]['mon'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['mon']['out']; if(isset($restarts[$i]['mon']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['mon']['img'];?>.png" alt="<?php echo $restarts[$i]['mon']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['mon'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="mon_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="mon_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
    <td>
        <?php if(!empty($restarts[$i]['tue'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['tue']['out']; if(isset($restarts[$i]['tue']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['tue']['img'];?>.png" alt="<?php echo $restarts[$i]['tue']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['tue'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="tue_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="tue_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
    <td>
        <?php if(!empty($restarts[$i]['wed'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['wed']['out']; if(isset($restarts[$i]['wed']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['wed']['img'];?>.png" alt="<?php echo $restarts[$i]['wed']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['wed'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="wed_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="wed_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
    <td>
        <?php if(!empty($restarts[$i]['thu'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['thu']['out']; if(isset($restarts[$i]['thu']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['thu']['img'];?>.png" alt="<?php echo $restarts[$i]['thu']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['thu'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="thu_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="thu_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
    <td>
        <?php if(!empty($restarts[$i]['fri'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['fri']['out']; if(isset($restarts[$i]['fri']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['fri']['img'];?>.png" alt="<?php echo $restarts[$i]['fri']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['fri'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="fri_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="fri_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
    <td>
        <?php if(!empty($restarts[$i]['sat'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['sat']['out']; if(isset($restarts[$i]['sat']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['sat']['img'];?>.png" alt="<?php echo $restarts[$i]['sat']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['sat'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="sat_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="sat_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
    <td>
        <?php if(!empty($restarts[$i]['sun'])){ ?>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $restarts[$i]['sun']['out']; if(isset($restarts[$i]['sun']['img'])){ ?><br /><img src="images/<?php echo $restarts[$i]['sun']['img'];?>.png" alt="<?php echo $restarts[$i]['sun']['alt'];?>" width="16" height="16"/><?php }?>
            </div>
        </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span6">
                <?php if(!empty($restarts[$i]['sun'])){ ?>
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>&amp;r=gs" method="post" onsubmit="return confirm('<?php echo $gsprache->sure;?>');">
                    <input type="hidden" name="date" value="sun_<?php echo $i;?>"/>
                    <input type="hidden" name="delete" value="delete" />
                    <button class="btn btn-danger btn-mini"><i class="icon-trash icon-white"></i></button>
                </form>
                <?php } ?>
            </div>
            <div class="span6">
                <form action="userpanel.php?w=ca&amp;id=<?php echo $server_id;?>" method="post">
                    <input type="hidden" name="date" value="sun_<?php echo $i;?>"/>
                    <input type="hidden" name="edit" value="edit" />
                    <button class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i></button>
                </form>
            </div>
        </div>
    </td>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</div>
</div>