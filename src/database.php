<?php

function getConnection()
{
    return new \mysqli('mysql', 'root', '1234', 'citest');
}