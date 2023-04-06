<?php
    namespace class;

    if(userInfo::isConnected()){
        header("Location: /userPassword");
        exit();
    }

    $title = "Mot de passe oublié - Étape 2";
    metaTitle::setTitle($title);
    metaTitle::setRobot(array("noindex", "nofollow"));

    additionnalJsCss::set("form.js");

    $messageError = "Lien invalide";

    if(isset($_GET["email"]) && isset($_GET["token"])){
        $email = $_GET["email"];
        $token = $_GET["token"];

        $tokenLifetime = $gng_paramList->get("forgetPasswordTokenLifetime") * 60; // Convert minutes to seconds

        $user = \model\userInfo::getByEmail($email);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if($user){
                if(!validator::isNullOrEmpty($user["tokenForgetPassword"])){
                    if($user["tokenForgetPassword"] == $token){
                        $tokenPart = explode(",", $user["tokenForgetPassword"]);
                        $tokenKey = $tokenPart[0]; // The token key
                        $tokenDate = $tokenPart[1]; // The token date
                        if($tokenDate+$tokenLifetime > time()){ // check if token is expired or not

                            $form = new form(array(
                                "action" => "",
                                "method" => "post",
                                "class" => "form",
                            ));

                            $form->setElement("input", array(
                                "name" => "password",
                                "type" => "password",
                                "required" => "required",
                                "placeholder" => "Mot de passe",
                                "minlength" => $gng_paramList->get("passwordMinLength"),
                                "maxlength" => $gng_paramList->get("passwordMaxLength"),
                                "class" => "w100",
                                "value" => (isset($_POST["password"])) ? $_POST["password"] : ""),
                                array(
                                    "before" => "Mot de passe:"
                                )
                            );

                            $form->setElement("input", array(
                                "name" => "passwordConfirm",
                                "type" => "password",
                                "required" => "required",
                                "placeholder" => "Confirmation du mot de passe",
                                "minlength" => $gng_paramList->get("passwordMinLength"),
                                "maxlength" => $gng_paramList->get("passwordMaxLength"),
                                "class" => "w100",
                                "value" => (isset($_POST["passwordConfirm"])) ? $_POST["passwordConfirm"] : ""),
                                array(
                                    "before" => "Confirmation du mot de passe:"
                                )
                            );

                            $form->setElement("input", array(
                                "type" => "submit",
                                "name" => "submit",
                                "value" => "Valider",
                                "class" => "btn btn-primary w100 mt10",
                            ));

                            if(isset($_POST["submit"])){
                                $password = $_POST["password"];
                                $passwordConfirm = $_POST["passwordConfirm"];

                                if($password == $passwordConfirm){
                                    $newPassword = password::hash($password);
                                    $update = db::update(array("password" => $newPassword, "passwordAlgo" => DEFAULT_ALGO, "tokenForgetPassword" => NULL), "user", array("tokenForgetPassword" => $user["tokenForgetPassword"])); // i update the password
                                    if($update){
                                        $msgSuccess = "Votre mot de passe a été modifié avec succès.";
                                    }else{
                                        $msgError = "Une erreur interne est survenue lors de la modification de votre mot de passe.";
                                    }
                                }else{
                                    $msgError = "Les mots de passe ne correspondent pas.";
                                }
                            }

                        }else{
                            $msgError = "Lien expiré";
                        }
                    }else{
                        $msgError = $messageError;
                    }
                }else{
                    $msgError = $messageError;
                }
            }else{
                $msgError = $messageError;
            }
        }else{
            $msgError = $messageError;
        }
    }else{
        $msgError = $messageError;
    }

    mcv::addView("userForm");