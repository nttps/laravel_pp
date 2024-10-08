<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    // Include to pre-defined routes from package or not. Middlewares
    'use_package_routes' => true,

    // Middlewares which should be applied to all package routes.
    // For laravel 5.1 and before, remove 'web' from the array.
    'middlewares' => ['web', 'auth'],

    // The url to this package. Change it if necessary.
    'url_prefix' => 'media',

    /*
    |--------------------------------------------------------------------------
    | Multi-User Mode
    |--------------------------------------------------------------------------
    */

    // If true, private folders will be created for each signed-in user.
    'allow_multi_user' => false,
    // If true, share folder will be created when allow_multi_user is true.
    'allow_share_folder' => true,

    // Flexible way to customize client folders accessibility
    // If you want to customize client folders, publish tag="lfm_handler"
    // Then you can rewrite userField function in App\Handler\ConfigHander class
    // And set 'user_field' to App\Handler\ConfigHander::class
    // Ex: The private folder of user will be named as the user id.
    'user_field' => UniSharp\LaravelFilemanager\Handlers\ConfigHandler::class,

    /*
    |--------------------------------------------------------------------------
    | Working Directory
    |--------------------------------------------------------------------------
    */

    // Which folder to store files in project, fill in 'public', 'resources', 'storage' and so on.
    // You should create routes to serve images if it is not set to public.
    'base_directory' => 'storage/app/public',

    'images_folder_name' => 'images',
    'files_folder_name'  => 'images',

    'shared_folder_name' => 'media',
    'thumb_folder_name'  => 'thumbs',

    /*
    |--------------------------------------------------------------------------
    | Startup Views
    |--------------------------------------------------------------------------
    */

    // The default display type for items.
    // Supported: "grid", "list"
    'images_startup_view' => 'grid',
    'files_startup_view' => 'list',

    /*
    |--------------------------------------------------------------------------
    | Upload / Validation
    |--------------------------------------------------------------------------
    */

    // If true, the uploaded file will be renamed to uniqid() + file extension.
    'rename_file' => true,

    // If rename_file set to false and this set to true, then non-alphanumeric characters in filename will be replaced.
    'alphanumeric_filename' => false,

    // If true, non-alphanumeric folder name will be rejected.
    'alphanumeric_directory' => false,

    // If true, the uploading file's size will be verified for over than max_image_size/max_file_size.
    'should_validate_size' => false,

    'max_image_size' => 50000,
    'max_file_size' => 50000,

    // If true, the uploading file's mime type will be valid in valid_image_mimetypes/valid_file_mimetypes.
    'should_validate_mime' => false,

    // available since v1.3.0
    'valid_image_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
        'image/svg+xml',
    ],

    // If true, image thumbnails would be created during upload
    'should_create_thumbnails' => true,

    // Create thumbnails automatically only for listed types.
    'raster_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
    ],

    // permissions to be set when create a new folder or when it creates automatically with thumbnails
    'create_folder_mode' => 0755,

    // permissions to be set on file upload.
    'create_file_mode' => 0644,

    // If true, it will attempt to chmod the file after upload
    'should_change_file_mode' => true,

    // available since v1.3.0
    // only when '/laravel-filemanager?type=Files'
    'valid_file_mimetypes' => [
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/gif',
        'image/svg+xml',
        'application/pdf',
        'text/plain',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ],

    /*
    |--------------------------------------------------------------------------
    | Image / Folder Setting
    |--------------------------------------------------------------------------
    */

    'thumb_img_width' => 200,
    'thumb_img_height' => 200,

    /*
    |--------------------------------------------------------------------------
    | File Extension Information
    |--------------------------------------------------------------------------
    */

    'file_type_array' => [
        'pdf'  => 'Adobe Acrobat',
        'doc'  => 'Microsoft Word',
        'docx' => 'Microsoft Word',
        'xls'  => 'Microsoft Excel',
        'xlsx' => 'Microsoft Excel',
        'zip'  => 'Archive',
        'gif'  => 'GIF Image',
        'jpg'  => 'JPEG Image',
        'jpeg' => 'JPEG Image',
        'png'  => 'PNG Image',
        'ppt'  => 'Microsoft PowerPoint',
        'pptx' => 'Microsoft PowerPoint',
        'mp4' => 'Media',
    ],

    'file_icon_array' => [
        'pdf'  => '../images/files/pdf.svg',
        'doc'  => '../images/files/doc.svg',
        'docx' => '../images/files/doc.svg',
        'xls'  => '../images/files/xls.svg',
        'xlsx' => '../images/files/xls.svg',
        'zip'  => '../images/files/zip.svg',
        'gif'  => '../images/files/gif.svg',
        'jpg'  => '../images/files/jpg.svg',
        'jpeg' => '../images/files/jpg.svg',
        'png'  => '../images/files/png.svg',
        'ppt'  => '../images/files/ptt.svg',
        'pptx' => '../images/files/ptt.svg',
        'mp4' => '../images/files/mp4.svg',
    ],

    /*
    |--------------------------------------------------------------------------
    | php.ini override
    |--------------------------------------------------------------------------
    |
    | These values override your php.ini settings before uploading files
    | Set these to false to ingnore and apply your php.ini settings
    |
    | Please note that the 'upload_max_filesize' & 'post_max_size'
    | directives are not supported.
    */
    'php_ini_overrides' => [
        'memory_limit'        => '256M',
    ],

];
