<?php 

class fileModel extends CI_Model
{
    public static function toJpeg($filename, $quality = 75)
    {
        $path = 'assets/uploads/';
        $file = $path . $filename;
        $type = exif_imagetype($file);
        $array = explode('.', $filename);
        $extension = $array[count($array) - 1];
        list($w, $h) = getimagesize($file);
        $image = imagecreatetruecolor($w, $h);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, $w, $h, $white);
        switch ($type) {
            case 1:
                {
                    $temp = imagecreatefromgif($file);
                    break;
                }
            case 2:
                {
                    $temp = imagecreatefromjpeg($file);
                    break;
                }
            case 3:
                {
                    $temp = imagecreatefrompng($file);
                    break;
                }
            default:
                {
                    return $filename;
                }
        }
        imagecopy($image, $temp, 0, 0, 0, 0, $w, $h);

        $new_name = str_replace($extension, 'jpg', $filename);
        $output = $path . $new_name;
        if (imagejpeg($image, $output, $quality)) {
            imagedestroy($image);
            imagedestroy($temp);
            if ($output !== $file) {
                unlink($file);
            }
            return $new_name;
        }
        return $filename;
    }

    public static function thumbnail($filename)
    {
        return fileModel::crop($filename);
    }

    public static function folder($dir)
    {
        if (!is_dir($dir)) {
            $folders = explode('/', $dir);
            $new = '';
            foreach ($folders as $folder) {
                $new .= $folder . '/';
                (!is_dir($new)) ? mkdir($new) : false;
            }
        }
        return $dir;
    }

    public static function delete($file, $json)
    {

        $path = fileModel::folder('assets/uploads/');
        $filename = $path . $file;
        $trash_dir = fileModel::folder($path . 'trash/' . $file . '/');
        $array = explode('/', $file);
        $trash = $trash_dir . $array[1];
        file_put_contents($trash_dir . 'readme.json', $json);
        if (file_exists($filename) && copy($filename, $trash)) {
            return unlink($filename);
        }
        return false;

    }

    public static function upload($source, $name, $type = '*')
    {
        $name_array = explode('.', $name);
        $ext = $name_array[count($name_array) - 1];
        $date = strftime('%Y-%m-%d', time());
        $dir = fileModel::folder('assets/uploads/' . $date);
        $filename = md5(time() . substr(str_shuffle('QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10)) . '.' . $ext;
        $dest = $dir . '/' . $filename;
        move_uploaded_file($source, $dest);
        return $date . '/' . $filename;
    }

    public static function crop($file, $w = 300, $h = 300)
    {
        $array = explode('/', $file);
        $name = $array[count($array) - 1];
        $original_file = 'assets/uploads/' . $file;
        $dir = fileModel::folder('assets/uploads/' . $array[0] . '/' . $w . 'X' . $h . '/');
        $output_path = $dir . $name;
        if(!file_exists($original_file)){
            return false;
        }
        if(file_exists($output_path)){
            return $output_path;
        }
        $save = $output_path ;
        
        $pass_width = $w;
        $pass_height = $h;

        $image = imagecreatefromjpeg($original_file);
        list($width, $height) = getimagesize($original_file);


        $original_aspect = $width / $height;
        $thumb_aspect = $w / $h;

        if ($original_aspect >= $thumb_aspect) {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $h;
            $new_width = $width / ($height / $h);
        } else {
            // If the thumbnail is wider than the image
            $new_width = $w;
            $new_height = $height / ($width / $w);
        }

        $thumb = imagecreatetruecolor($w, $h);


        imagecopyresampled(
            $thumb,
            $image,
            0 - ($new_width - $w) / 2, // Center the image horizontally
            0 - ($new_height - $h) / 2, // Center the image vertically
            0,
            0,
            $new_width,
            $new_height,
            $width,
            $height
        );

        imagejpeg($thumb, $save, 80);
        imagedestroy($thumb);

        $image = $output_path;
        list($w, $h) = getimagesize($image);
        $nh = $pass_height;
        $nw = $pass_width;
        //$nw = 1300;
        //$nh = ($nw * $h)/$w;
        $area = $w * $h;
        $n_area = $nh * $nh;
        $src = imagecreatefromjpeg($image);

        $thumb = imagecreatetruecolor($nw, $nh);
        imagecopyresampled($thumb, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);
       
        imagejpeg($thumb, $save, 100);
        return $output_path;
    }












}