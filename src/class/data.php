<?php
    namespace class;

    abstract class data{
        function isArrOfArr($variable) {
            return !empty(array_filter($variable, 'is_array'));
        }
    }