<?php

namespace class;


if(email::send("Test", "cyrilhovh@gmail.com",  "Cyril", "<b>Test</b> via class PHP.", "Test via class PHP.")){
    echo "Email sent";
}else{
    echo "Email not sent";
}
?> 