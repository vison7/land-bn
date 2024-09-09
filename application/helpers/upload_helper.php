<?php
/**
 * @params path
 * @param request form
 * @return image name
 */
if (!function_exists('upload_image')) {
	function upload_image($path,$form_img_field_name , $new_name){

		if (is_uploaded_file( $form_img_field_name["tmp_name"] )) {
			$filename = explode(".", $form_img_field_name["name"]);
			$filenameext = $filename[count($filename)-1];
			$filename = $new_name .".".$filenameext;
			copy($form_img_field_name["tmp_name"] , $path ."/". $filename );
			return $filename;
		}else{
			return "";
		}
	}
}

/**
 * @params path
 * @param request form
 * @return image name array
 */
if (!function_exists('uploadImgMultiFile')) {
	function uploadImgMultiFile($path,$pictures){
		$arr_name = array();
		$i=0;

		foreach ($_FILES[$pictures]["error"] as $key => $error) {
			$filename = "";
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES[$pictures]["tmp_name"][$key];
				$origfilename = $_FILES[$pictures]["name"][$key];
				$filename = explode(".", $_FILES[$pictures]["name"][$key]);
				$filenameext = $filename[count($filename)-1];
				$filename = date("YmdHis")."$i.".$filenameext;
				copy($tmp_name , $path ."/". $filename );
			}
			$arr_name[$i] = $filename;
			$i++;
		}
		return $arr_name;
	}
}

/**
 * @params root path
 * @param folder name
 * @return path name
 */
if (!function_exists('create_folder_by_char')) {
	function create_folder_by_char($path,$folder){
		$dir ="";
		$arr1 = preg_split('//', $folder, -1, PREG_SPLIT_NO_EMPTY);
		for($i = 0,$len = strlen($folder) ; $i < $len; $i++)
		{
			$d = $arr1[$i];
			$dir .= $d ."/";

			if(!is_dir($path . $dir )){
				mkdir($path . $dir);
				chmod($path . $dir, 0777);
			}
		}
		return $dir;
	}
}

/**
 * @params root path
 * @param date string  YYYY/mm/dd
 * @return path name
 */
if (!function_exists('create_folder_by_date')) {
	function create_folder_by_date($path,$path_date=''){
		$dir ="";

		if($path_date==''){
			$arr1 = date("Y/m/d");
		}else{
			$arr1 = $path_date;
		}

		$folder = explode('/',$arr1);
		for($i = 0,$len = count($folder) ; $i < $len; $i++)
		{
			$d = $folder[$i];
			$dir .= $d ."/";

			if(!is_dir($path . $dir )){
				mkdir($path . $dir);
				chmod($path . $dir, 0777);
			}
		}
		return $dir;
	}
}

// require gd.dll
if (!function_exists('resizeImgToFile')) {
	function resizeImgToFile ($sourcefile, $dest_x, $dest_y, $targetfile, $jpegqual)
	{
		/* Get the dimensions of the source picture */
		$picsize=getimagesize("$sourcefile");

		// Get new sizes
		$max_width = $dest_x;
		$max_height = $dest_y;
		//list($orig_width, $orig_height) = getimagesize("data/".$filename);
		$width = $picsize[0];
		$height = $picsize[1];

		# taller
		if ($height > $max_height) {
			$width = ($max_height / $height) * $width;
			$height = $max_height;
		}
		# wider
		if ($width > $max_width) {
			$height = ($max_width / $width) * $height;
			$width = $max_width;
		}

		$source_x  = $picsize[0];
		$source_y  = $picsize[1];
		//$source_id = imageCreateFromJPEG("$sourcefile");

		if(preg_match("/.jpg/i", "$sourcefile")){
			$source_id = imagecreatefromjpeg($sourcefile);
		}
		if(preg_match("/.jpeg/i", "$sourcefile")){
			$source_id = imagecreatefromjpeg($sourcefile);
		}
		if(preg_match("/.png/i", "$sourcefile")){
			$source_id = imagecreatefrompng($sourcefile);
		}
		if(preg_match("/.gif/i", "$sourcefile")){
			$source_id = imagecreatefromgif($sourcefile);
		}

		/* Create a new image object (not neccessarily true colour) */
		$target_id=imagecreatetruecolor($width, $height);

		/* Resize the original picture and copy it into the just created image
		 object. Because of the lack of space I had to wrap the parameters to
		 several lines. I recommend putting them in one line in order keep your
		 code clean and readable */

		$target_pic=imagecopyresampled($target_id,$source_id,
		0,0,0,0,
		$width,$height,
		$source_x,$source_y);

		/* Create a jpeg with the quality of "$jpegqual" out of the
		 image object "$target_pic".
		 This will be saved as $targetfile */

		//imagejpeg ($target_id,"$targetfile",$jpegqual);

		if(preg_match("/.jpg/i", "$sourcefile")){
			imagejpeg($target_id,"$targetfile",$jpegqual);
		}
		if(preg_match("/.jpeg/i", "$sourcefile")){
			imagejpeg($target_id,"$targetfile",$jpegqual);
		}
		if(preg_match("/.png/i", "$sourcefile")){
			imagepng($target_id,"$targetfile",9);
		}
		if(preg_match("/.gif/i", "$sourcefile")){
			imagegif($target_id,"$targetfile",$jpegqual);
		}

		return true;
	}
}
?>