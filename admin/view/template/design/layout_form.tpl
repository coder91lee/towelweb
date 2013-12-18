<?php echo $header; ?>
<script src="view/javascript/multifile_compressed.js"></script>
<script  src="view/javascript/jquery/jquery-ui.js"></script>

 <style>
          #sortable1 li, #sortable2 li, #sortable3 li, #sortable4 li, #sortable5 li, #sortable6 li, #sortable7 li, #sortable8 li, #sortable9 li,#sortable10 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
          </style>
  <script>
          
  
          $(function() {
            $( "#sortable1, #sortable2, #sortable3, #sortable4, #sortable5, #sortable6, #sortable7, #sortable8, #sortable9, #sortable10" ).sortable().disableSelection();

			
            var $tabs = $( "#tabs" ).tabs();

            var $tab_items = $( "ul:first li", $tabs ).droppable({
              accept: ".connectedSortable li",
              hoverClass: "ui-state-hover",
              drop: function( event, ui ) {
			  	
                var $item = $( this );
                var $list = $( $item.find( "a" ).attr( "href" ) )
                  .find( ".connectedSortable" );

                ui.draggable.hide( "slow", function() {
                  $tabs.tabs( "select", $tab_items.index( $item ) );
                  $( this ).appendTo( $list ).show( "slow" );
				  
                });
				
              }
			
            });
			  
			 
			
          });
		  
		  function update(){
		  	 $("#tabs-1").find( "input" ).attr("name", "module_arr[]");
  		     $("#tabs-2").find( "input" ).attr("name", "modules_top[]");
			 $("#tabs-3").find( "input" ).attr("name", "modules_left[]");
			 $("#tabs-4").find( "input" ).attr("name", "modules_body[]");
			 $("#tabs-5").find( "input" ).attr("name", "modules_right[]");
			 $("#tabs-6").find( "input" ).attr("name", "modules_bottom[]");
			 $("#tabs-7").find( "input" ).attr("name", "module_arr[]");
			 $("#tabs-8").find( "input" ).attr("name", "modules_body_m[]");
			 $("#tabs-9").find( "input" ).attr("name", "module_arr[]");
			 $("#tabs-10").find( "input" ).attr("name", "module_arr[]");
		 }
		 
		 function tabpc(){
		  	 $(".interface_mobile").attr('style', 'display:none');
			 $(".interface_pc").attr('style', 'display:block');
			 changetab();
		 }
		 
		 function tabmobile(){
		  	 $(".interface_pc").attr('style', 'display:none');
			 $(".interface_mobile").attr('style', 'display:block');
			 changetab();
		 }
		 
		 function changetab()
		 {
		 	$("#tabs").attr('id', 'tabst');
			 $("#tabst").attr('style', 'display:none');
			 
			 $("#abc").attr('id', 'tabs');
			 $("#tabs").attr('style', '');
			 
			 $("#tabst").attr('id', 'abc');
			 
			 $( "#sortable1, #sortable2, #sortable3, #sortable4, #sortable5, #sortable6, #sortable7, #sortable8" ).sortable().disableSelection();

			
            var $tabs = $( "#tabs" ).tabs();

            var $tab_items = $( "ul:first li", $tabs ).droppable({
              accept: ".connectedSortable li",
              hoverClass: "ui-state-hover",
              drop: function( event, ui ) {
			  	
                var $item = $( this );
                var $list = $( $item.find( "a" ).attr( "href" ) )
                  .find( ".connectedSortable" );

                ui.draggable.hide( "slow", function() {
                  $tabs.tabs( "select", $tab_items.index( $item ) );
                  $( this ).appendTo( $list ).show( "slow" );
				  
                });
				
              }
			
            });
		 }
          </script>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/layout.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="update();$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
	
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	   
        <table  class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
            <td><input type="text" name="name" value="<?php echo $name; ?>" />
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php } ?></td>
          </tr>
        </table>
		<table id="route" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_route; ?></td>
              
            </tr>
          </thead>
          <tbody >
            <tr>
              <td class="left"><input type="text" name="layout_route[<?php echo $route_row; ?>][route]" value="<?php if(isset($layout_route))echo $layout_route['route']; ?>" /></td>
            </tr>
          </tbody>
        </table>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		<li class="ui-state-default ui-corner-top ui-droppable ui-tabs-selected ui-state-active">
			<div class="interface_mobile" onclick="tabpc();"><a>Giao diện Mobile</a></div>
			<div class="interface_pc" onclick="tabmobile();" style="display:none"><a>Giao diện PC</a></div>
		</li>
		</ul>
	 </div>
	 
	
	 <div id="pc">
		<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="abc" style="display:none">
		  <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top ui-droppable ui-tabs-selected ui-state-active"><a href="#tabs-1">Modules</a></li>
			<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-2">Content Top</a></li>
			<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-3">Content Left</a></li>
			<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-4">Content Body</a></li>
			<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-5">Content Right</a></li>
			<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-6">Content Bottom</a></li>
			<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-9">Từ layout chuyển sang</a></li>
		  </ul>
		  
		 
		   <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-1">	  
			  <div style="float:left; margin-left:10px;";>
			  <div class="scrollbox_layout">
				<ul id="sortable7" class="connectedSortable ui-helper-reset ui-sortable">
				  <?php if(isset($modules) && $modules)								
					 foreach($modules as $module){ ?>		
						<li style="width: 200px;"class="ui-state-default"><?php echo $module['name']?><input name="module_arr[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
				 <?php }?>
				</ul>
				</div>
				</div>
			</div>
		  <div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-2">
		   <div class="scrollbox_layout">
			<ul id="sortable2" class="connectedSortable ui-helper-reset ui-sortable">
			  <?php if(isset($modules_in_layout) && $modules_in_layout){?>
									<?php
										foreach($modules_in_layout as $module)	
										if($module['layout_pos'] == 1){							
											 
									?>
										<li style="width: 200px;" class="ui-state-highlight"><?php echo $module['name']?><input name="modules_in_layout[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
									<?php }?>
								<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-3">
		   <div class="scrollbox_layout">
			<ul id="sortable3" class="connectedSortable ui-helper-reset ui-sortable">
			  <?php if(isset($modules_in_layout) && $modules_in_layout){?>
									<?php
										foreach($modules_in_layout as $module)	
										if($module['layout_pos'] == 2){							
											 
									?>
										<li style="width: 200px;" class="ui-state-highlight"><?php echo $module['name']?><input name="modules_in_layout[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
									<?php }?>
								<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-4">
			<div class="scrollbox_layout">
			<ul id="sortable4" class="connectedSortable ui-helper-reset ui-sortable">
			  <?php if(isset($modules_in_layout) && $modules_in_layout){?>
									<?php
										foreach($modules_in_layout as $module)	
										if($module['layout_pos'] == 3){							
											 
									?>
										<li style="width: 200px;" class="ui-state-highlight"><?php echo $module['name']?><input name="modules_in_layout[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
									<?php }?>
								<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-5">
			<div class="scrollbox_layout">
			<ul id="sortable5" class="connectedSortable ui-helper-reset ui-sortable">
			  <?php if(isset($modules_in_layout) && $modules_in_layout){?>
									<?php
										foreach($modules_in_layout as $module)	
										if($module['layout_pos'] == 4){							
											 
									?>
										<li style="width: 200px;" class="ui-state-highlight"><?php echo $module['name']?><input name="modules_in_layout[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
									<?php }?>
								<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-6">
		   <div class="scrollbox_layout">
			<ul id="sortable6" class="connectedSortable ui-helper-reset ui-sortable">
			  <?php if(isset($modules_in_layout) && $modules_in_layout){?>
									<?php
										foreach($modules_in_layout as $module)	
										if($module['layout_pos'] == 5){							
											 
									?>
										<li style="width: 200px;" class="ui-state-highlight"><?php echo $module['name']?><input name="modules_in_layout[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
									<?php }?>
								<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-9">
			<div class="scrollbox_layout">
			<ul id="sortable9" class="connectedSortable ui-helper-reset ui-sortable">
			  
			</ul>
			</div>
			</div>
	   </div>
   </div>
   
 <div id="mobile">
	 	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-droppable ui-tabs-selected ui-state-active"><a href="#tabs-7">Modules</a></li>
				<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-8">Content Body</a></li>
				<li class="ui-state-default ui-corner-top ui-droppable"><a href="#tabs-10">Từ layout chuyển sang</a></li>
			  </ul>
			  
			  <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-7">	  
			  <div style="float:left; margin-left:10px;";>
			  <div class="scrollbox_layout">
				<ul id="sortable7" class="connectedSortable ui-helper-reset ui-sortable">
				  <?php if(isset($modules) && $modules)								
					 foreach($modules as $module){ ?>		
						<li style="width: 200px;"class="ui-state-default"><?php echo $module['name']?><input name="module_arr[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
				 <?php }?>
				</ul>
				</div>
				</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-8">
			<div class="scrollbox_layout">
			<ul id="sortable8" class="connectedSortable ui-helper-reset ui-sortable">
			  <?php if(isset($modules_in_layout_m) && $modules_in_layout_m){?>
									<?php
										foreach($modules_in_layout_m as $module)	
										if($module['layout_pos'] == 3){							
											 
									?>
										<li style="width: 200px;" class="ui-state-highlight"><?php echo $module['name']?><input name="modules_body_m[]" type="hidden" value="<?php echo $module['module_id']?>" /></li>
									<?php }?>
								<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-10">
			<div class="scrollbox_layout">
			<ul id="sortable10" class="connectedSortable ui-helper-reset ui-sortable">
			  
			</ul>
			</div>
			</div>
		</div>
	 </div>	 
  <!-- End demo -->
  <!-- End demo-description -->
      </form>
    </div>
  </div>
</div>

<?php echo $footer; ?>

<script type="text/javascript"><!--
$('#abc a').tabs(); 
//--></script> 