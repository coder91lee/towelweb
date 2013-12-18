<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error) { ?>
  <div class="warning"><?php echo $error; ?></div>
  <?php } ?>
  <div class="box">
    <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a><a onclick="$('form').submit();" class="button"><span><?php echo $button_delete; ?></span></a></div>
    </div>
	<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
    <div class="content">
      <table class="list">
        <thead>
          <tr>
		  	<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left"><?php echo $column_name; ?></td>
			<td class="left">Module Code</td>
            <td class="right"><?php echo $column_action; ?></td>
          </tr>
        </thead>
        <tbody>
        	 <tr class="filter">
                        
              <TD></TD>         
              <td><input type="text" name="filter_name" value="" /></td>              
              <td><input type="text" name="filter_name" value="" /></td>    
              <td align="right"><a onclick="filter();" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
        
        
          <?php if ($modules) { ?>
          <?php foreach ($modules as $module) { ?>
          <tr>
		  	<td style="text-align: center;"><?php if ($module['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $module['module_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $module['module_id']; ?>" />
                <?php } ?></td>
            <td class="left"><?php echo $module['name']; ?></td>
            <td class="left"><?php echo $module['code'] ?></td>
           
            <td class="right">
              [<a href="<?php echo $module['action']; ?>">Edit</a> ]</td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
	  </form>
	  <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>

<?php echo $footer; ?>