<?php
/**
 * @Target  this file to make enum for all system
 * @note can call it in all system if give it key we return only we send
 */
/**
 * @Target this all type media in system
 * avatar @uses  user , image
 * file @uses   user , ad , task
 * document @uses  ad , task , user
 * logo @uses social , nationality , setting
 */
function mediaType()
{
    return ['am' => 'avatar', 'fm' => 'file', 'dm' => 'document', 'lo' => 'logo','im' => 'image'];
}
/**
 * @Target this path type we can save in it
 * images @uses user , setting , social , nationality
 * uploads @uses user , ad , task
 */
function pathType()
{
    return ['ip' => 'images', 'up' => 'uploads'];
}
/**
 * @Target this all status for all system
 * @note 1 : active
 * @note 0 : un active
 * @uses user , category , city , state ,  forgotPassword ,checkMobile , language
 */
function activeType()
{
    return ['as' => 1, 'us' => 0];
}

/**
 * @Target this all status
 * @uses log
 * view @note when open page in system
 * create @note when store new row in database for anything in system
 * update @note when edit in row in database for anything in system
 * generate code @note for forget password and check mobile to check it
 * reset password @note forget password for user
 * change status @note when change status anything in system
 * login @note when user login to system
 * logout @note when user logout for system
 * add Offer @note when user add Offer in task
 * edit Offer @note when user edit Offer in task
 */
function actionType()
{
    return ['va' => 'view', 'ca' => 'create', 'ua' => 'update', 'gca' => 'generate code', 'rpa' => 'reset password', 'sa' => 'change status',
        'la' => 'login', 'loa' => 'logout', 'da'=>'delete',
    'ra'=>'restore','rea'=>'remove','pa'=>'problem','csa'=>'cansel','read'=>'read notification'];
}

function permissionGroup()
{
    return ['syp'=>'system','ap'=>'acl','cp'=>'core_data','sp'=>'setting'];
}
