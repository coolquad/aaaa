<?php 
	define('TBL_CAT','tbl_category');
	$$primary_key = $_REQUEST[$primary_key];
	//echo "primary key".$_REQUEST[$primary_key]."<br>";
	$act = ($$primary_key != '')?'Edit':'Add';
	//echo $act;

	$heading="Manage ".$entity." &raquo; ".$act." ".$entity;
	if(isset($_REQUEST['gallery_main_id']))
	{
		$gallery_main_id=$_REQUEST['gallery_main_id'];
		//$gallery_id		=$_REQUEST['gallery_id'];
		$selectGallerySql=$wpdb->get_row($wpdb->prepare("select * from tbl_gallery_main where gallery_main_id=$gallery_main_id",""));
		//$selectGalleryMain=$wpdb->get_row($wpdb->prepare("select * from `tbl_gallery_main` where  gallery_main_id=$gallery_main_id",""));
		$categoryId=$selectGallerySql->category_id;
		$subcategoryId=$selectGallerySql->subcategory_id;
		$title=$selectGallerySql->title;
		$description=$selectGallerySql->description;
		$seotitle=$selectGallerySql->gallery_seotitle;
		$metatitle=$selectGallerySql->meta_title;
		$metadescription=$selectGallerySql->meta_description;
		//$metakeyword=$selectGallerySql->meta_keywords;
		$status=$selectGallerySql->status;
		$ishome=$selectGallerySql->ishome;
		if(count($selectGallerySql)>0)
		{
			$before_image_thumb=$selectGallerySql->before_image_thumb;
			$after_image_thumb=$selectGallerySql->after_image_thumb;
			//@unlink(UPLOAD_PATH.$folder_name.'/before/'.$before_image_thumb);
			//@unlink(UPLOAD_PATH.$folder_name.'/after/'.$after_image_thumb);

			//@unlink(UPLOAD_PATH.$folder_name.'/before_thumb/'.$before_image_thumb);
			//@unlink(UPLOAD_PATH.$folder_name.'/after_thumb/'.$after_image_thumb);
		
			//@unlink(UPLOAD_PATH.$folder_name.'/before_medium/'.$before_image_thumb);
			//@unlink(UPLOAD_PATH.$folder_name.'/after_medium/'.$after_image_thumb);
	
			//$deleteGallerySql="delete from tbl_gallery_main where gallery_main_id=$gallery_main_id";
			//$deleteGallerySqlConnect=mysql_query($deleteGallerySql);
		}
	
	}
	elseif($_REQUEST['gallery_main_id']!="")
	{
		$gallery_main_id=$_REQUEST['gallery_main_id'];
		$selectGallerySql=$wpdb->get_row($wpdb->prepare("select * from `tbl_gallery_main` where gallery_main_id=$gallery_main_id",""));
		$categoryId=$selectGallerySql->category_id;
		$subcategoryId=$selectGallerySql->subcategory_id;
		$title=$selectGallerySql->title;
		$description=$selectGallerySql->description;
		$seotitle=$selectGallerySql->gallery_seotitle;
		$metatitle=$selectGallerySql->meta_title;
		$metadescription=$selectGallerySql->meta_description;
		$metakeyword=$selectGallerySql->meta_keywords;
		$status=$selectGallerySql->status;
		$ishome=$selectGallerySql->ishome;
	}
?>

<script type="text/javascript" src="<?php echo PLUGIN_URL;?>inc/js/main.js"></script>

<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/ckeditor/ckeditor.js"></script>

<style type="text/css">

#previews{

	position:absolute;

	border:1px solid #ccc;

	background:#333;

	padding:5px;

	display:none;

	color:#fff;

	}

	</style>	

<div class="wrap" >

  <div id="icon-edit-pages" class="icon32" align="left"></div>

  <h2><?php echo $heading;?></h2>

</div>

<div align="center"><br />

  <font color="#ff0000"><?php echo $alert; ?></font><br />

</div>

<div class="wrap" id="box1" style=" width:90%;">

  <?php	

  			

  		if ($$primary_key != '' && $hidAction == '') {

		}

		else {

			extract($_POST);

		}

	

 ?>

  <form enctype="multipart/form-data" name="add" id="add" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  onsubmit="return validate();" >

    <table cellspacing="0" class="widefat" width="100%" >

      <thead>

        <tr class="nodrag nodrop">

          <th colspan="3"><b><?php echo $act.' '.$entity; ?></b></th>
        </tr>
         <tr>

          <th colspan="3"><span style="color:red; font-size:10px">'Is Home' is Applicable for Smile Gallery Category</span></th>

		     

        </tr>

      </thead>

      <tbody>

     <tr align="left">

          <td width="150">Gallery Name<font color="#FF0000">*</font> </td>

          <td width="585" align="left"><select name="txtCategory" id="txtCategory" tabindex="101">

              <option value="Select">Select</option>

              <?php


		$categories=$wpdb->get_results(
					"
					SELECT * 
					FROM tbl_category
					WHERE status = 'Y'
					ORDER BY ordering
					"
				);

			$countCategory=count($categories);

			if($countCategory>0)

			{

			foreach ( $categories as $values ) 

			{
		  	
			?>

              <option value="<?php echo $values->category_id; ?>" <?php if($values->category_id==$categoryId){ echo "selected";} ?>><?php echo $values->category_name; ?></option>

              <?php	

				}

			}

			

		  ?>

            </select>

          </td>

          <td width="163">&nbsp;</td>

        </tr>

	<?php /* ?>
            <tr>
			
			<td colspan="3"  id="subcategory">
			<?php
				 if($$primary_key!=""){
	     		$subcategories = $wpdb->get_results( 
				"
				SELECT subcategory_id,subcategory_name 
				FROM tbl_gallerysubcategory
				WHERE category_id =".$categoryId." and status='Y'  
				"
			);		  
		  $count=count($subcategories);
		  if($count>0)
		  {
		  ?>
			<table>
				<tr>
			
			
			
			
			
			
			
			
              <td width="150" colspan="">Category Name<font color="#FF0000">*</font></td>
              <td colspan="583" align="left">
                <select name="subcat" id="subcat">
                  <?php
				foreach ( $subcategories as $values ) 
				{
			  ?>
                  <option <?php if($values->subcategory_id==$subcategoryId){echo "selected";}?> value="<?php echo $values->subcategory_id; ?>"><?php echo $values->subcategory_name; ?></option>
                  <?php
				}
			  ?>
                  </select>
          </td>
		  
		  <td width="163">&nbsp;</td>
		  
		  
		  
		  
		  
		  
		  
		  
		  </tr>

		  </table>
		        <?php
		  }
		  }
		  ?>
		  </td>
		  
              </tr>

  

        </tr>

			
            <tr>
              <td width="106" colspan="">Sub Category Name<font color="#FF0000">*</font></td>
              <td colspan="4" align="left" id="subcategory"><?php
				 if($$primary_key!=""){
	     		$subcategories = $wpdb->get_results( 
				"
				SELECT subcategory_id,subcategory_name 
				FROM tbl_gallerysubcategory
				WHERE category_id =".$categoryId." and status='Y'  
				"
			);		  
		  $count=count($subcategories);
		  if($count>0)
		  {
		  ?>
                <select name="subcat" id="subcat">
                  <option value="0">Select Sub Category</option>
                  <?php
				foreach ( $subcategories as $values ) 
				{
			  ?>
                  <option <?php if($values->subcategory_id==$subcategoryId){echo "selected";}?> value="<?php echo $values->subcategory_id; ?>"><?php echo $values->subcategory_name; ?></option>
                  <?php
				}
			  ?>
                  </select>
                <?php
		  }
		  }
		  ?></td>
              </tr>

  

  
  <script type="text/javascript">

// Category Onchange Loads Subcategory
	jQuery("#txtCategory").change(function(){
		var subcat=jQuery(this).val();
		jQuery.ajax({
			url:'<?php echo PLUGIN_URL;?>gallery/sub_category.php',
			type:'POST',
			data:{id:subcat},
			success: function(data) {
				jQuery("#subcategory").html(data);
		  }
	});
	});


</script>		
    <?php */ ?>          <tr>

                <td colspan="4" style="padding:0px !important; border-bottom:0px;">

				<table width="95%" border="0" cellspacing="0" cellpadding="0">

<?php /*?>  <tr>

    <td width="150" colspan="">Main Title<font color="#FF0000">*</font></td>

                <td colspan="3" align="left"><input type="text" name="txtMainTitle" id="txtMainTitle" value="<?php echo $title;?>" tabindex="102"/></td>

                <td width="6">&nbsp;</td>

              </tr>

		  

			    <tr> 

				 <td width="150" colspan="">Main Description<font color="#FF0000"></font></td>

                <td colspan="3" align="left">

               

                

                <textarea  name="txtMainDesc"  id="txtMainDesc" rows="2" cols="70" tabindex="103"><?php echo $description;?></textarea>

				<script type="text/javascript">

					CKEDITOR.replace('txtMainDesc');

				</script>                </td>

                 <td width="6">&nbsp;</td>

              </tr>
<?php */?>	
<?php

		$gallery_main_id=$_REQUEST['gallery_main_id'];

		if($gallery_main_id!="")

		{

		$selectMainGallerySql=$wpdb->get_results($wpdb->prepare("select * from tbl_gallery_main where gallery_main_id=".$gallery_main_id,""));

		$countMainGallerySql=count($selectMainGallerySql);

		if($countMainGallerySql>0)

		{

?>			  

			  <tr><td colspan="4" align="center"> <?php

			  if(isset($_REQUEST['msg']))

			  {

			  		if($_REQUEST['msg']=="delete")

					{

						echo "<font color='#FF0000'>Gallery deleted successfully</font>";

					}

			  }

			  ?> </td>

			  </tr>

			  <tr><td colspan="4"><table width="800"  bgcolor="#ECECEC">

			

<?php



			for($k=0;$k<$countMainGallerySql;$k++)//edit

			{?>

 <tr> 

	<td colspan="4" id="beforeafterdetails">
 <table width="800" border="1" cellspacing="0" id="beforeafter_1" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" >



                   <tr>

                     <td width="121">Before Image Title<font color="#FF0000">*</font></td>

                     <td width="313"><input type="text" name="txtBeforeImageTitle_1" id="txtBeforeImageTitle_1" value="<?php echo $selectMainGallerySql[$k]->before_imagetitle;; ?>"  tabindex="104"/></td>

                     <td width="121">After Image Title<font color="#FF0000">*</font></td>

                     <td width="322"><input type="text" name="txtAfterImageTitle_1" id="txtAfterImageTitle_1" value="<?php echo $selectMainGallerySql[$k]->after_imagetitle; ?>" tabindex="106"/></td>

                   </tr>

				   

                   <tr>

                     <td width="121">Before Image Alt</td>

                     <td width="313"><input type="text" name="txtBeforeImageAlt_1" id="txtBeforeImageAlt_1" value="<?php echo $selectMainGallerySql[$k]->before_imagealt; ?>"  tabindex="107"/></td>

                     <td width="121">After Image Alt</td>

                     <td width="322"><input type="text" name="txtAfterImageAlt_1" id="txtAfterImageAlt_1" value="<?php echo $selectMainGallerySql[$k]->after_imagealt; ?>" tabindex="108"/></td>

                   </tr>				   

				   

				   

				     <tr>

				       <td> Before Image<font color="#FF0000">*</font></td>

				       <td><input tabindex="109" type="file" id="before_image_1" value=""  name="before_image_1" />

					  <?php if($$primary_key!="") {?><a href="<?php echo bloginfo('url')."/wp-content/uploads/gallery/before_thumb/".$selectMainGallerySql[$k]->before_image_thumb; ?>" onclick="return false;" class="previews">view </a><?php }?>					  </td>

				       <td> After Image<font color="#FF0000">*</font></td>

				       <td><input type="file" id="after_image_1" value="" name="after_image_1" tabindex="110"/>

                      <?php if($$primary_key!="") {?><a href="<?php echo bloginfo('url')."/wp-content/uploads/gallery/after_thumb/".$selectMainGallerySql[$k]->after_image_thumb; ?>" onclick="return false;" class="previews">view </a><?php }?>					  </td>

			        </tr>

				     <tr>

                     <td>&nbsp;</td>

                     <td>(Restricted to Jpg, Gif and Png) </td>
					 
					<td width="121">Is Home</td>

                     <td width="313"><input type="checkbox" name="ishome_1" id="is_home_1" value="Y" <?php echo ($ishome=='Y')?'checked="checked"':''; ?> tabindex="104"/></td>					 
					 
					 
					 
					 
					 
					 
					 
                    </tr>
					<tr>

                     <td>Before Description</td>

                     <td><textarea name="description_1" id="description_1" ><?php echo $selectMainGallerySql[$k]->description; ?></textarea></td>
					<td>After Description</td>
					<td><textarea name="bdescription_1" id="bdescription_1" ><?php echo $selectMainGallerySql[$k]->meta_description; ?></textarea></td>
                    </tr>
					<tr>

					<td><input type="hidden" name="hidbefore_image" value="<?php echo $selectMainGallerySql[$k]->before_image_thumb; ?>"><input type="hidden" name="hidafter_image" value="<?php echo $selectMainGallerySql[$k]->after_image_thumb; ?>">
					
					
					<input type="hidden" name="merged_image" value="<?php echo $selectMainGallerySql[$k]->merged_image; ?>"><input type="hidden" name="merged_thumb" value="<?php echo $selectMainGallerySql[$k]->merged_thumb; ?>">
					
					</td>

					</tr>

                 </table>
</td>
</tr>				 
  

		

<?php

			}

?>

			  </table></td></tr>

<?php

	}

	}

?>			  


			   <tr> 

				 <td colspan="4" id="beforeafterdetails">

           <?php  if($$primary_key=="")  { ?>

				 <table width="800" border="1" cellspacing="0" id="beforeafter_1" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" >



                   <tr>

                     <td width="121">Before Image Title<font color="#FF0000">*</font></td>

                     <td width="313"><input type="text" name="txtBeforeImageTitle_1" id="txtBeforeImageTitle_1" value=""  tabindex="104"/></td>

                     <td width="121">After Image Title<font color="#FF0000">*</font></td>

                     <td width="322"><input type="text" name="txtAfterImageTitle_1" id="txtAfterImageTitle_1" value="" tabindex="106"/></td>

                   </tr>

				   

                   <tr>

                     <td width="121">Before Image Alt</td>

                     <td width="313"><input type="text" name="txtBeforeImageAlt_1" id="txtBeforeImageAlt_1" value=""  tabindex="107"/></td>

                     <td width="121">After Image Alt</td>

                     <td width="322"><input type="text" name="txtAfterImageAlt_1" id="txtAfterImageAlt_1" value="" tabindex="108"/></td>

                   </tr>				   

				   

				   

				     <tr>

				       <td> Before Image<font color="#FF0000">*</font></td>

				       <td><input tabindex="109" type="file" id="before_image_1" value=""  name="before_image_1" />

					 	  </td>

				       <td> After Image<font color="#FF0000">*</font></td>

				       <td><input type="file" id="after_image_1" value="" name="after_image_1" tabindex="110"/>

                     				  </td>

			        </tr>

				     <tr>

                     <td>&nbsp;</td>

                     <td>(Restricted to Jpg, Gif and Png) </td>
					<td width="121">Is Home</td>

                     <td width="313"><input type="checkbox" name="ishome_1" id="is_home_1" value="Y" tabindex="104"/></td>
                    </tr>
					<tr>

                     <td>Before Description</td>

                     <td ><textarea name="description_1" id="description_1" ></textarea></td>

                  

					<td>After Description</td>
					<td><textarea name="bdescription_1" id="bdescription_1" ></textarea></td>

					  </tr>
					
                 </table>

                 

                 <?php } ?>                 </td>

                 

                 

                <td width="6">&nbsp;</td>

              </tr>

			  

			  

			  

              <tr>

                <td width="104">&nbsp;</td>

                <td width="317" align="center"><a href="javascript:void(0);" id="addmore"  >Add More</a> </td>

                <td colspan="2" align="left">&nbsp;</td>

                <td width="6">&nbsp;</td>

              </tr>

			<!--   <tr>

			  <td>Seo Title<span style=" color:#F00;">*</span></td><td><input type="text" name="seo_title" id="seo_title" tabindex="111" value="<?php // echo $seotitle;?>"></td> <td colspan="2" align="left">&nbsp;</td>

                <td width="6">&nbsp;</td>

			  </tr>-->

<!--			  <tr>

			  <td>Meta Title<span style=" color:#F00;">*</span></td><td><textarea name="meta_title" id="meta_title" tabindex="112" ><?php // echo $metatitle;?></textarea></td>

			   <td colspan="2" align="left">&nbsp;</td>

                <td width="6">&nbsp;</td>

			  </tr>

-->			<?php /*?>  <tr>

			  <td>Meta Description<span style=" color:#F00;">*</span></td><td><textarea name="meta_description" id="meta_description" tabindex="113" rows="4" cols="35"><?php echo $metadescription;?></textarea></td>

			   <td colspan="2" align="left">&nbsp;</td>

                <td width="6">&nbsp;</td>

			  </tr><?php */?>

			 <!-- <tr>

			  <td>Meta Keywords</td><td><textarea name="meta_keywords" id="meta_keywords" tabindex="114" rows="4" cols="35"><?php //echo $metakeyword;?></textarea></td>

			   <td colspan="2" align="left">&nbsp;</td>

                <td width="6">&nbsp;</td>

			  </tr>-->

</table>



				</td>

              </tr>

          

        <tr align="left">

          <td width="106"  valign="middle">Status<span style=" color:#F00;">*</span></td>

          <td colspan="2" align="left"><input type="radio" name="status" value="Y" <?php echo ($status=='Y' || $status=='')?'checked="checked"':''; ?> tabindex="115"/>

            Yes &nbsp;

            <input type="radio" name="status" value="N" <?php echo ($status=='N')?'checked="checked"':''; ?>  tabindex="116"/>

            No </td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td>&nbsp;

              <label class="submit">

              <?php 

			if($$primary_key!="")

			{

			?>

              <input name="submit"  type="submit" title="Update"  value="Update"/>

              <?php

			}

			else

			{

			?>

              <input name="submit"  type="submit" title="Save"  value="Save"/>

              <?php

			}

			?>

              <!-- <input  type="submit"  value="Submit" name="list" />-->

              </label>

              <label class="submit">

			 

              <input type="hidden" id="hidCatImg" name="hidCatImg" value="<?php echo $category_image;?>" />

              <input name="button"  type="button"  title="Cancel" onclick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name; ?>');"  value="Cancel" tabindex="114"/>

              </label>

          </td>

          <td>&nbsp;</td>

        </tr>

      </tbody>

    </table>

	 <input type="hidden" name="gallery_count" id="gallery_count" value="1">

	 <?php

	 if($$primary_key!='')

	 {

    $selectPrevCatid=$wpdb->get_row($wpdb->prepare("select category_id,subcategory_id from tbl_gallery_main where gallery_main_id=".$$primary_key,""));

	

	 ?>

	 <input type="hidden" name="prev_cat_id" id="prev_cat_id" value="<?php echo $selectPrevCatid->category_id; ?>" />
	 <input type="hidden" name="prev_subcat_id" id="prev_subcat_id" value="<?php echo $selectPrevCatid->subcategory_id; ?>" />

	 <?php

	 }

	 ?>

    <input type="hidden" name="hidAction" id="hidAction" value="<?php echo ($$primary_key!='')?'edit':'add'; ?>" />

	<input type="hidden" name="<?php echo $primary_key; ?>" id="<?php echo $primary_key; ?>" value="<?php echo $$primary_key; ?>" />

  </form>

</div>

<script type="text/javascript">



function validate()

{

	var gallery_count=jQuery("#gallery_count").val();

	//alert(gallery_count);



	if(jQuery.trim(jQuery('#txtCategory').val())=='' || jQuery.trim(jQuery('#txtCategory').val())=='Select')

	{

		 alert("Please select a Gallery Name.");

		 jQuery('#txtCategory').focus();

		 return false;

	 }
/*
	 	if(jQuery.trim(jQuery('#subcat').val())=='' || jQuery.trim(jQuery('#subcat').val())=='0')
	{
		 alert("Please Select Sub Category Name.");
		 jQuery('#subcat').focus();
		 jQuery('#subcat').select();
		 return false;
	 }

*/



if(jQuery.trim(jQuery('#txtBeforeImageTitle_1').val())==''){

	 alert("Please fill in Before Image Title.");

	 jQuery('#txtBeforeImageTitle_1').focus();

	 return false;

 }	 
 

if(jQuery.trim(jQuery('#before_image_1').val())!='')
{
	var checkext = validateimageext( jQuery('#before_image_1').val()  ); 
	//alert(checkext); 
	if(checkext  == false )
	{
		alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
		jQuery('#before_image_1').focus();
		return false;
	}
									
}
 

 if(jQuery.trim(jQuery('#txtAfterImageTitle_1').val())=='')

{

	 alert("Please fill in After Image Title.");

	 jQuery('#txtAfterImageTitle_1').focus();

	 return false;

 }

 
if(jQuery.trim(jQuery('#after_image_1').val())!='')
{
	var checkext = validateimageext( jQuery('#after_image_1').val()  ); 
	//alert(checkext); 
	if(checkext  == false )
	{
		alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
		jQuery('#after_image_1').focus();
		return false;
	}
									
}


									 /*if(jQuery.trim(jQuery('#txtMainTitle').val())=='')

	{

		 alert("Please fill in Main Title.");

		 jQuery('#txtMainTitle').focus();

		 return false;

	 }*/

	 

/*	  var str=CKEDITOR.instances.txtMainDesc.getData();



     if(str=='')

	 {

	

		 alert("Please fill in Main Description.");

		 var str=CKEDITOR.instances.txtMainDesc;

		 str.focus() ;

		 return false;

	 }  

	 
*/
	 

	 

		

			<?php

				

				if($$primary_key!="")

				{

			?> 

						 for(var i=2;i<=gallery_count;i++)

						 {

						 if(document.getElementsByName('txtBeforeImageTitle_'+i+'').length!=0) 

							 {  

						

									if(jQuery.trim(jQuery('#txtBeforeImageTitle_'+i+'').val())=='')

									{

									 alert("Please fill in Before Image Title.");

									 jQuery('#txtBeforeImageTitle_'+i+'').focus();

									 return false;

									 }	 

									 if(jQuery.trim(jQuery('#before_image_'+i+'').val())=='')

									{

									 alert("Please upload Before Image.");

									 jQuery('#before_image_'+i+'').focus();

									 return false;

									 }

									 if(jQuery.trim(jQuery('#before_image_'+i+'').val())!='')
									{
										var checkext = validateimageext( jQuery('#before_image_'+i+'').val()  ); 
										//alert(checkext); 
										if(checkext  == false )
										{
											alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
											jQuery('#before_image_'+i+'').focus();
											return false;
										}
																		
									}

									 if(jQuery.trim(jQuery('#txtAfterImageTitle_'+i+'').val())=='')

									{

									 alert("Please fill in After Image Title.");

									 jQuery('#txtAfterImageTitle_'+i+'').focus();

									 return false;

									 }

									 

									 if(jQuery.trim(jQuery('#after_image_'+i+'').val())=='')

									{

									 alert("Please upload After Image.");

									 jQuery('#after_image_'+i+'').focus();

									 return false;

									 }

									 if(jQuery.trim(jQuery('#after_image_'+i+'').val())!='')
									{
										var checkext = validateimageext( jQuery('#after_image_'+i+'').val()  ); 
										//alert(checkext); 
										if(checkext  == false )
										{
											alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
											jQuery('#after_image_'+i+'').focus();
											return false;
										}
																		
									}

									 

								}

									 

							}	

			

			

			<?php

			   }

			   else

			   {

			?>

	

				 for(var i=1;i<=gallery_count;i++)

				 {

				 if(document.getElementsByName('txtBeforeImageTitle_'+i+'').length!=0) 

					 {  

				

							if(jQuery.trim(jQuery('#txtBeforeImageTitle_'+i+'').val())=='')

							{

							 alert("Please fill in Before Image Title.");

							 jQuery('#txtBeforeImageTitle_'+i+'').focus();

							 return false;

							 }	 

							 if(jQuery.trim(jQuery('#before_image_'+i+'').val())=='')

							{

							 alert("Please upload Before Image.");

							 jQuery('#before_image_'+i+'').focus();

							 return false;

							 }
									 if(jQuery.trim(jQuery('#before_image_'+i+'').val())!='')
									{
										var checkext = validateimageext( jQuery('#before_image_'+i+'').val()  ); 
										//alert(checkext); 
										if(checkext  == false )
										{
											alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
											jQuery('#before_image_'+i+'').focus();
											return false;
										}
																		
									}

							 

							 if(jQuery.trim(jQuery('#txtAfterImageTitle_'+i+'').val())=='')

							{

							 alert("Please fill in After Image Title.");

							 jQuery('#txtAfterImageTitle_'+i+'').focus();

							 return false;

							 }

							 

							 if(jQuery.trim(jQuery('#after_image_'+i+'').val())=='')

							{

							 alert("Please upload After Image.");

							 jQuery('#after_image_'+i+'').focus();

							 return false;

							 }

										 if(jQuery.trim(jQuery('#after_image_'+i+'').val())!='')
									{
										var checkext = validateimageext( jQuery('#after_image_'+i+'').val()  ); 
										//alert(checkext); 
										if(checkext  == false )
										{
											alert("Please upload a valid File format('.png','.gif','.jpg','.jpeg') for Image.");
											jQuery('#after_image_'+i+'').focus();
											return false;
										}
																		
									}
						 

						}

							 

					}

					

					

				<?php

				}

			?>

	/*	if(jQuery.trim(jQuery('#seo_title').val())=='')

	{

		 alert("Please fill in Seo Title.");

		 jQuery('#seo_title').focus();

		 return false;

	 }

	if(jQuery.trim(jQuery('#meta_title').val())=='')

	{

		 alert("Please fill in Meta Title.");

		 jQuery('#meta_title').focus();

		 return false;

	 }*/

	/*if(jQuery.trim(jQuery('#meta_description').val())=='')

	{

		 alert("Please fill in Meta Description.");

		 jQuery('#meta_description').focus();

		 return false;

	 }*/

	

	

	

		     document.add.gallery_count.value=gallery_count;

	         document.add.submit();

	

	

	 

	

}





jQuery("#addmore").click(function(){

	var gallery_count=jQuery("#gallery_count").val();

	gallery_count=parseInt(gallery_count)+parseInt(1);

	jQuery("#gallery_count").val(gallery_count);

	jQuery("#beforeafterdetails").append('<table width="800" border="1" cellspacing="0" id="beforeafter_'+gallery_count+'" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" ><tr><td colspan="4" align="right"><a href="javascript:void(0);" onClick=" removeUpBeforeAfter('+gallery_count+'); return false;" >Close Box</a></td></tr><tr><td width="98">Before Image Title<font color="#FF0000">*</font></td><td width="316"><input type="text" name="txtBeforeImageTitle_'+gallery_count+'" id="txtBeforeImageTitle_'+gallery_count+'" value="" /></td><td width="98">After Image Title<font color="#FF0000">*</font></td><td width="277"><input type="text" name="txtAfterImageTitle_'+gallery_count+'" id="txtAfterImageTitle_'+gallery_count+'" value="" /></td></tr><tr><td width="98">Before Image Alt</td><td width="316"><input type="text" name="txtBeforeImageAlt_'+gallery_count+'" id="txtBeforeImageAlt_'+gallery_count+'" value="" /></td><td width="98">After Image Alt</td><td width="277"><input type="text" name="txtAfterImageAlt_'+gallery_count+'" id="txtAfterImageAlt_'+gallery_count+'" value="" /></td></tr><tr><td> Before Image<font color="#FF0000">*</font></td><td><input type="file" id="before_image_'+gallery_count+'" value=""  name="before_image_'+gallery_count+'" /></td><td> After Image<font color="#FF0000">*</font></td><td><input type="file" id="after_image_'+gallery_count+'" value="" name="after_image_'+gallery_count+'" /></td></tr><tr><td>&nbsp;</td><td>(Restricted to Jpg, Gif and Png)</td><td width="121">Is Home</td><td width="313"><input type="checkbox" name="ishome_'+gallery_count+'" id="is_home_'+gallery_count+'" value="Y"/></td></tr><tr><td>Before Description</td><td colspan="3"><textarea name="description_'+gallery_count+'" id="description_'+gallery_count+'"></textarea></td><td>After Description</td><td><textarea name="bdescription_'+gallery_count+'" id="bdescription_'+gallery_count+'" ></textarea></td></tr></table>');

});

function removeUpBeforeAfter(closeId)

{

	var gallery_count=jQuery("#gallery_count").val();

	gallery_count=parseInt(gallery_count)-parseInt(1);

	jQuery("#gallery_count").val(gallery_count);



	jQuery("#beforeafter_"+closeId).remove();

	

}





jQuery(".deletegallery").click(function(){

	var deleteconfirmation=confirm('Are you sure you want to delete the selected record.?');

	if(deleteconfirmation)

	{

		var url=jQuery(this).attr('url');

		window.location=url;

	}



});



function validateimageext(filenameval)
{


var extensions = new Array("jpg","jpeg","gif","png");
var image_file = filenameval;
var image_length = image_file.value;
var pos = image_file.lastIndexOf('.') + 1;
var ext = image_file.substring(pos, image_length);
var final_ext = ext.toLowerCase();
for (i = 0; i < extensions.length; i++)
{
    if(extensions[i] == final_ext)
    {
    return true;
    }
}
//alert("You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".");
return false;
}
</script>