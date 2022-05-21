<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class customTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds for custom translation.
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $custom = [
                ['key'=>'Title','value'=>'Title'],
                ['key'=>'Name','value'=>'Name'],
                ['key'=>'Copy','value'=>'Copy'],
                ['key'=>'Index','value'=>'Index'],
                ['key'=>'Language','value'=>'Language'],
                ['key'=>'DashBoard','value'=>'DashBoard'],
                ['key'=>'Create','value'=>'Create'],
                ['key'=>'Status','value'=>'Status'],
                ['key'=>'Controller','value'=>'Controller'],
                ['key'=>'An_active','value'=>'An Active'],
                ['key'=>'Active','value'=>'Active'],
                ['key'=>'Edit','value'=>'Edit'],
                ['key'=>'Code','value'=>'Code'],
                ['key'=>'Order','value'=>'Order'],
                ['key'=>'Media','value'=>'Media'],
                ['key'=>'Image','value'=>'Image'],
                ['key'=>'Core_Data','value'=>'Core Data'],
                ['key'=>'City','value'=>'City'],
                ['key'=>'State','value'=>'State'],
                ['key'=>'Select','value'=>'Select'],
                ['key'=>'Delete','value'=>'Delete'],
                ['key'=>'Trash','value'=>'Trash'],
                ['key'=>'Category','value'=>'Category'],
                ['key'=>'Update','value'=>'Update'],
                ['key'=>'Restore','value'=>'Restore'],
                ['key'=>'Close','value'=>'Close'],
                ['key'=>'Home','value'=>'Home'],
                ['key'=>'Restore_Message','value'=>'Are you Need To Restore This'],
                ['key'=>'Delete_Message','value'=>'Are you Need To Delete This'],
                ['key'=>'Remove_Message','value'=>'Are you Need To Delete This Forever'],
                ['key'=>'Delete_Index_Message','value'=>'Data you Deleted At Before'],
                ['key'=>'Enter_Name','value'=>'Enter Title'],
                ['key'=>'Enter_Code','value'=>'Enter Code'],
                ['key'=>'Enter_Order','value'=>'Enter Order'],
                ['key'=>'Create_Done','value'=>'Create Done'],
                ['key'=>'Done','value'=>'Done'],
                ['key'=>'Edit_Done','value'=>'Edit Done'],
                ['key'=>'Delete_Done','value'=>'Delete Done'],
                ['key'=>'Restore_Done','value'=>'Restore Done'],
                ['key'=>'An_Active_Done','value'=>'An Active Done'],
                ['key'=>'Active_Done','value'=>'Active Done'],
                ['key'=>'Meta','value'=>'Meta'],
                ['key'=>'Setting','value'=>'Setting'],
                ['key'=>'Role','value'=>'Role'],
                ['key'=>'Acl','value'=>'Acl'],
                ['key'=>'Permission','value'=>'Permission'],
                ['key'=>'all','value'=>'All'],
                ['key'=>'User','value'=>'User'],
                ['key'=>'Email','value'=>'Email'],
                ['key'=>'Password','value'=>'Password'],
                ['key'=>'Password_Confirmation','value'=>'Password Confirmation'],
                ['key'=>'Enter_Full_Name','value'=>'Enter Full Name'],
                ['key'=>'Enter_User_Name','value'=>'Enter User Name'],
                ['key'=>'Enter_Email','value'=>'Enter Email'],
                ['key'=>'Enter_Password','value'=>'Enter Password'],
                ['key'=>'Enter_Password_Confirmation','value'=>'Enter Password Confirmation'],
                ['key'=>'Mobile','value'=>'Mobile'],
                ['key'=>'Enter_Mobile','value'=>'Enter Mobile'],
                ['key'=>'subject','value'=>'Subject'],
                ['key'=>'message','value'=>'Message'],
                ['key'=>'Message_Support','value'=>'Places Call Admin'],
                ['key'=>'Avatar','value'=>'Avatar'],
                ['key'=>'Thank_you','value'=>"Thank you"],
                ['key'=>'problem','value'=>'Sorry But there Was an issue in saving Data please try again'],
                ['key'=>'accept','value'=>'accept'],
                ['key'=>'reject','value'=>'reject'],
                ['key'=>'An_Approve_Done','value'=>'An Approve Done'],
                ['key'=>'reject_title','value'=>'places write reject comment'],
                ['key'=>'created_at','value'=>'create at'],
                ['key'=>'contact_us','value'=>'Contact Us'],
                ['key'=>'ContactUs','value'=>'Contact Us'],
                ['key'=>'description','value'=>'Description'],
                ['key'=>'failed' ,'value'=> 'These credentials do not match our records.'],
                ['key'=>'failed_password' ,'value'=> 'The provided password is incorrect.'],
                ['key'=>'password_change' ,'value'=> 'The password change sucseed.'],
                ['key'=>'throttle' ,'value'=> 'Too many login attempts. Please try again in :seconds seconds.'],
                ['key'=> 'login','value'=>'login success'],
                ['key'=>'login_here','value'=>'login here'],
                ['key'=>'register_here','value'=>'register here'],
                ['key'=>'support','value'=>'call support'],
                ['key'=>'register_before','value' => 'register before'],
                ['key'=>'login_first' ,'value'=> 'places login'],
                ['key'=>'code_wrong','value'=>'code wrong'],
                ['key'=>'code_send','value'=>'check your mobile'],
                ['key'=>'code_used','value'=>'this code used before'],
                ['key'=> 'customTranslation','value' => 'Custom Translation'],
                ['key'=> 'key','value' => 'Key'],
                ['key'=> 'value','value' => 'Value'],
                ['key'=> 'Enter_Key','value' => 'Enter Key'],
                ['key'=> 'Enter_Value','value' => 'Enter Value'],
                ['key'=> 'login_page','value' => 'Login'],
                ['key'=> 'login_start','value' => 'Sign in to start your session'],
                ['key'=> 'sign_in','value' => 'Sign In'],
                ['key'=> '404','value' => '404 Page not found'],
                ['key'=> 'Oops','value' => 'Oops! Page not found.'],
                ['key'=> 'email_approve','value' => 'email approve'],
                ['key'=> 'mobile_approve','value' => 'mobile approve'],
                ['key'=> 'country_id','value' => 'country'],
                ['key'=> 'role_id','value' => 'role'],
                ['key'=> 'state_id','value' => 'state'],
                ['key'=> 'status_id','value' => 'status'],
                ['key'=> 'user_id','value' => 'user'],
                ['key'=> 'or','value' => 'او'],
                ['key'=> 'next','value' => 'next'],
                ['key'=> 'last','value' => 'last'],
                ['key'=> 'of','value' => 'of'],
                ['key'=> 'Displaying','value' => 'Displaying'],
                ['key' => 'client', 'value' => 'client'],
                ['key' => 'count', 'value' => 'count'],
                ['key' => 'to', 'value' => 'to'],
                ['key' => 'from', 'value' => 'from'],
                ['key' => 'done_by', 'value' => 'done by'],
                ['key' => 'logout', 'value' => 'logout'],
                ['key' => 'logout_done', 'value' => 'logout Done'],
                ['key' => 'favourite', 'value' => 'Favourite'],
                ['key' => 'unactive', 'value' => 'unactive'],
                ['key' => 'forgot_password', 'value' => 'I forgot my password'],
                ['key' => 'recover_password', 'value' => 'Recover Password'],
                ['key' => 'forgot_password_title', 'value' => 'forgot password'],
                ['key' => 'Request_password', 'value' => 'Request new password'],
                ['key' => 'message_recover_password', 'value' => 'You are only one step a way from your new password, recover your password now.'],
                ['key' => 'message_forgot_password', 'value' => 'You forgot your password? Here you can easily retrieve a new password.'],
                ['key' => 'login_button', 'value' => 'login'],
                ['key' => 'confirm_password', 'value' => 'Confirm Password'],
                ['key' => 'pusher', 'value' => 'pusher'],
                ['key' => 'receiver', 'value' => 'receiver'],
                ['key' => 'Enter_fullname', 'value' => 'Enter fullname'],
                ['key' => 'fullname', 'value' => 'fullname'],
                ['key' => 'username', 'value' => 'username'],
                ['key' => 'home_setting', 'value' => 'Home Setting'],

        ];
        foreach ($custom as $value) {
            $data = app()->make(CustomTranslationService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),false,false,10,'count');
            if ($data == 0) {
                $data = CustomTranslation::create(['key' => strtolower($value['key'])]);
                foreach (language() as $lang) {
                    $data->translation()->create(['key' => 'value', 'value' => $value['value'], 'language_id' => $lang->id]);
                }
            }
        }
    }
}
