<?php
 if(!empty($file)){ // i check if the file is not empty
    if(!empty($file["name"])){ // i check if the file name is not empty
        if(!empty($file["tmp_name"])){ // i check if the file tmp_name is not empty
            if(!empty($file["size"])){ // i check if the file size is not empty
                if(!empty($file["error"])){ // i check if the file error is not empty
                    if($file["error"] == 0){ // i check if the file error is equal to 0
                        if(in_array($file["type"], $fileAllowed)){ // i check if the file type is in the array of allowed file types
                            if($override == true){ // i check if the override is true
                                if(file_exists($target.$file["name"])){ // i check if the file already exists
                                    if($rename == true){ // i check if the rename is true
                                        $file["name"] = file::rename($file["name"]);
                                    }
                                    if(!file_exists($target.$file["name"])){ // i check if the file already exists
                                        if(move_uploaded_file($file["tmp_name"], $target.$file["name"])){ // i move the file
                                            $return["name"] = $file["name"];
                                            $return["size"] = $file["size"];
                                            $return["type"] = $file["type"];
                                            $return["path"] = $target.$file["name"];
                                        }else{
                                            $error[] = "Error while moving the file";
                                        }
                                    }else{
                                        $error[] = "File already exists";
                                    }
                                }else{
                                    if(move_uploaded_file($file["tmp_name"], $target.$file["name"])){ // i move the file
                                        $return["name"] = $file["name"];
                                        $return["size"] = $file["size"];
                                        $return["type"] = $file["type"];
                                        $return["path"] = $target.$file["name"];
                                    }else{
                                        $error[] = "Error while moving the file";
                                    }
                                }
                            }else{