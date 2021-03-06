<div class="row-fluid">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a href="admin.php">Home</a> <span class="divider">/</span></li>
            <li><a href="admin.php?w=ui"><?php echo $gsprache->userImport;?></a> <span class="divider">/</span></li>
            <li><?php echo $gsprache->mod;?> <span class="divider">/</span></li>
            <li class="active"><?php echo $domain;?></li>
        </ul>
    </div>
</div>
<div class="row-fluid">
    <dl class="dl-horizontal">
        <dt><?php echo $sprache->lastExternalID;?></dt>
        <dd><?php echo $lastID;?></dd>
        <dt><?php echo $sprache->lastCheck;?></dt>
        <dd><?php echo $lastCheck;?></dd>
    </dl>
</div>
<div class="row-fluid">
    <div class="span6">
        <form class="form-horizontal" action="admin.php?w=ui&amp;d=md&amp;id=<?php echo $id;?>&amp;r=ui" onsubmit="return confirm('<?php echo $gsprache->sure; ?>');" method="post">
            <input type="hidden" name="token" value="<?php echo token();?>">
            <input type="hidden" name="action" value="md">
            <div class="control-group">
                <label class="control-label" for="inputActive"><?php echo $gsprache->active;?></label>
                <div class="controls">
                    <select id="inputActive" name="active">
                        <option value="N"><?php echo $gsprache->no;?></option>
                        <option value="Y" <?php if ($active=="Y") echo 'selected="selected"'; ?>><?php echo $gsprache->yes;?></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputSSL"><?php echo $sprache->ssl;?></label>
                <div class="controls">
                    <select id="inputSSL" name="ssl">
                        <option value="N"><?php echo $gsprache->no;?></option>
                        <option value="Y" <?php if ($ssl=="Y") echo 'selected="selected"'; ?>><?php echo $gsprache->yes;?></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputDomain"><?php echo $sprache->domain;?></label>
                <div class="controls">
                    <input id="inputDomain" type="text" name="domain" value="<?php echo $domain;?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFile"><?php echo $sprache->file;?></label>
                <div class="controls">
                    <input id="inputFile" type="text" name="file" value="<?php echo $file;?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputToken">Token</label>
                <div class="controls">
                    <input id="inputToken" type="text" name="accessToken" value="<?php echo $token;?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFetchUpdates"><?php echo $sprache->fetchUpdates;?></label>
                <div class="controls">
                    <select id="inputFetchUpdates" name="fetchUpdates">
                        <option value="N"><?php echo $gsprache->no;?></option>
                        <option value="Y" <?php if ($fetchUpdates=="Y") echo 'selected="selected"'; ?>><?php echo $gsprache->yes;?></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputChunkSize">chunkSize</label>
                <div class="controls">
                    <input id="inputChunkSize" type="number" name="chunkSize" value="<?php echo $chunkSize;?>" maxlength="19" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputGroupID"><?php echo $sprache->groupID;?></label>
                <div class="controls">
                    <select id="inputGroupID" name="groupID">
                        <?php foreach ($groupIDS as $k=>$v){ ?><option value="<?php echo $k;?>" <?php if ($groupID==$k) echo 'selected="selected"'; ?>><?php echo $v;?></option><?php } ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEdit"></label>
                <div class="controls">
                    <button class="btn btn-primary pull-right" id="inputEdit" type="submit"><i class="icon-edit icon-white"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>