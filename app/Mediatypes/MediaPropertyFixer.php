<?php

namespace App\Mediatypes;

class MediaPropertyFixer {

	public function resizeAndSaveImage($img, $filename, $directory)
	{
		$watermark400 = \Image::make( public_path('watermark400.png') );
		$watermark200 = \Image::make( public_path('watermark200.png') );

        $width = $img->width();
        $height = $img->height();
        $img->backup();

        if ($width > $height)
        {
            $img->fit(1900, 1078);
			$img->insert($watermark400, 'bottom-right', 180, 200);
			$img->insert($watermark400, 'top-left', 180, 200);
            $img->save( storage_path('app/public/'.$directory.'/full/').$filename );

            $img->reset();

            $img->fit(390, 285);
			$img->insert($watermark200, 'top-left', 20, 20);
            $img->save( storage_path('app/public/'.$directory.'/display/').$filename );
        }
        else
        {
            if($height < 811)
            {
				$img->insert($watermark200, 'bottom-right', 160, 160);
				$img->insert($watermark200, 'top-left', 160, 160);
                $img->save( storage_path('app/public/'.$directory.'/full/').$filename );
            }
            else
            {
                $img->resize(null, 810, function ($constraint) {
                    $constraint->aspectRatio();
                });
				$img->insert($watermark200, 'bottom-right', 160, 160);
				$img->insert($watermark200, 'top-left', 160, 160);
                $img->save( storage_path('app/public/'.$directory.'/full/').$filename );
            }

            $img->reset();

            if($height < 401)
            {
				$img->insert($watermark200, 'bottom-right', 60, 60);
				$img->insert($watermark200, 'top-left', 60, 60);

                $img->save( storage_path('app/public/'.$directory.'/display/').$filename );
            }
            else
            {
                $img->resize(390, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

				$img->insert($watermark200, 'bottom-right', 60, 60);
				$img->insert($watermark200, 'top-left', 60, 60);

                $img->save( storage_path('app/public/'.$directory.'/display/').$filename );
            }

        }

        $img->reset();

        $img->fit(770, 513);
		$img->insert($watermark200, 'bottom-right', 90, 90);
		$img->insert($watermark200, 'top-left', 90, 90);
        $img->save( storage_path('app/public/'.$directory.'/page/').$filename );

        $img->reset();

        $img->fit(100, 100);
        $img->save( storage_path('app/public/'.$directory.'/thumb/').$filename );

        return true;
    }

}
