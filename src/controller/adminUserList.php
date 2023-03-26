<?php

namespace class;

metaTitle::setTitle('Liste des utilisateurs');
metaTitle::setDescription('Liste des utilisateurs du site.');
additionnalJsCss::set("table.css");
additionnalJsCss::set("tableSearch.js");

$userList = \model\userInfo::getUserList();



mcv::addView('adminUserList');