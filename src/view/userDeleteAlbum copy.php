<?php
    namespace class;

    use model\album;

    $meta_title = "Supprimer un album ".$meta_separator.$meta_title;


    if(isset($_GET['id'])){
        if(is_numeric($_GET['id'])){
            $id = $_GET['id'];

            $album = album::get($id);

            if($album){

                if($album["author"] == $_SESSION["username"] || userInfo::isAdmin()){
                    $formDeleteAlbum = new form(array( // i declare my new object
                        "method" => "post", // i give the method attr
                        "action" => "", // i give action attr
                        "class"=>"", // i give className ou className list (not required)
                    ));
                
                    $formDeleteAlbum->setElement("input", array(
                        "type" => "checkbox", // i give the type of input
                        "name" => "confirm", // i give a className
                        "required" => "required", // i add the attr required
                        "class" => "form-control" // i add a class to the element
                        ),
                        // add content after or before the element
                        array(
                            "after" => " <span class='bold red'>Supprimer l&apos;album &laquo; abc &raquo; définitivement et ses photos</span><br>",
                        )
                    );
                
                    $formDeleteAlbum->setElement("input", array(
                        "type" => "submit",
                        "value" => "Supprimer",
                        "name" => "submit",
                        "class" => "btn btn-danger form-control" // i add a class to the element
                    ));
                
                    if(isset($_POST['submit'])){
                        if($formDeleteAlbum->check()){
                            //$album->deleteAlbum($_GET['id']);
                
                        }else{
                            $errorList =$formDeleteAlbum->check(false);
                        }
                    }
                
                    mcv::addView("userDeleteAlbum");
                }else{
                    mcv::addView("403");
                }
                
            }else{
                mcv::addView("noContent"); // if the album doesn't exist, i display a message
            }
        }else{
            mcv::addView("noContent"); // if $_GET["id"] is wrong (not a number)
        }
    }else{
        mcv::addView("noContent"); // if $_GET["id"] is not set, i display a message
    }

?>