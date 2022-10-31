<?php
return [
// ----------------------------- MainController -----------------------------
    '' => [
        'name' => 'mainpage',
        'controller' => 'main',
        'action' => 'index',
    ],
    'directories-tree' => [
        'name' => 'tree',
        'controller' => 'main',
        'action' => 'getDirectoriesTree',
    ],
    'root' => [
        'name' => 'root',
        'controller' => 'main',
        'action' => 'root',
    ],
    'contact-us' => [
        'name' => 'feedback',
        'controller' => 'main',
        'action' => [
            'GET' => 'feedback',
            'POST' => 'sendFeedback',
        ],
    ],
// ----------------------------- UsersController -----------------------------
    'register' => [
        'name' => 'signup',
        'controller' => 'users',
        'action' => [
            'GET' => 'register',
            'POST' => 'executeRegister',
        ],
    ],
    'login' => [
        'name' => 'login',
        'controller' => 'users',
        'action' => [
            'GET' => 'login',
            'POST' => 'auth',
        ],
    ],
    'verification/{id:.+}' => [
        'name' => 'verifyMail',
        'controller' => 'users',
        'action' => 'verifyUserEmail',
    ],
    'password-recovery' => [
        'name' => 'forgetPwd',
        'controller' => 'users',
        'action' => [
            'GET' => 'forgetPassword',
            'POST' => 'sendRecoveryLink',
        ],
    ],
    'reset-password/{id:.+}' => [
        'name' => 'resetPwd',
        'controller' => 'users',
        'action' => [
            'GET' => 'recoveryPassword',
            'POST' => 'resetPassword',
        ],
    ],
    'logout' => [
        'name' => 'logout',
        'controller' => 'users',
        'action' => 'logout'
    ],
    'personal-account' => [
        'name' => 'account',
        'controller' => 'users',
        'action' => 'account'
    ],
    'add-user-info/{id:.+}' => [
        'name' => 'userinfo',
        'controller' => 'users',
        'action' => [
            'GET' => 'userInfo',
            'POST' => 'addUserInfo',
        ],
    ],
    'upload-user-info/{id:.+}' => [
    'name' => 'uploadUserinfo',
    'controller' => 'users',
    'action' => [
        'GET' => 'uploadInfo',
        'POST' => 'uploadUserInfo',
        ],
    ],
    'delete-user/{id:.+}' => [
        'name' => 'deleteUser',
        'controller' => 'users',
        'action' => 'deleteUser'
    ],
// ----------------------------- RbacController -----------------------------
    'root/users' => [
        'name' => 'usersList',
        'controller' => 'rbac',
        'action' => 'getUsers',
    ],
    'root/rbac' => [
        'name' => 'setRole',
        'controller' => 'rbac',
        'action' => [
            'GET' => 'setRole',
            'POST' => 'asignRole',
        ],
    ],
// ----------------------------- RolesController -----------------------------
    'root/roles' => [
        'name' => 'roles',
        'controller' => 'roles',
        'action' => 'showRoles',
    ],
    'root/new-role' => [
        'name' => 'new-role',
        'controller' => 'roles',
        'action' => [
            'GET' => 'addRole',
            'POST' => 'executeAddingRole'
        ],
    ],
    'root/delete-role/{id:.+}' => [
        'name' => 'deleteRole',
        'controller' => 'roles',
        'action' => 'deleteRole',
    ],
// ---------------------------- PermissionsController -----------------------------
    'root/permissions' => [
        'name' => 'permissions',
        'controller' => 'permissions',
        'action' => [
            'GET' => 'showPerms',
            'POST' => 'addPerms'
        ],
    ],
    'root/set-permissions-to-role' => [
        'name' => 'setPermissions',
        'controller' => 'permissions',
        'action' => [
            'GET' => 'setPermissions',
            'POST' => 'asignPermissions',
        ],
    ],
// ----------------------------- ImagesController -----------------------------
    'images' => [
        'name' => 'images',
        'controller' => 'images',
        'action' => 'show'
    ],
    'download-images' => [
        'name' => 'imgdownload',
        'controller' => 'images',
        'action' => [
            'GET' => 'downloadForm',
            'POST' => 'downloadImg',
        ],
    ],
// ----------------------------- FilesController -------------------------------
    'files' => [
        'name' => 'files',
        'controller' => 'files',
        'action' => 'filesList',
    ],
    'file/{id:.+}' => [
        'name' => 'showFile',
        'controller' => 'files',
        'action' => 'show',
    ],
    'upload-files' => [
        'name' => 'fileUpload',
        'controller' => 'files',
        'action' => [
            'GET' => 'uploadForm',
            'POST' => 'uploadFiles',
        ],
    ],
    'download-file/{id:.+}' => [
        'name' => 'fileDownload',
        'controller' => 'files',
        'action' => 'downloadFile',
    ],
    'edit-file/{id:.+}' => [
        'name' => 'editFile',
        'controller' => 'files',
        'action' => [
            'GET' => 'editForm',
            'POST' => 'editFile',
        ],
    ],
    'delete-file/{id:.+}' => [
        'name' => 'deleteFile',
        'controller' => 'files',
        'action' => 'deleteFile',
    ],
// --------------------------- MapsController -------------------------------
    'maps' => [
        'name' => 'maps',
        'controller' => 'maps',
        'action' => [
            'GET' => 'yandexMaps',
            'POST' => 'createGeoCollection',
        ],
    ],
    'maps/collections' => [
        'name' => 'geoCollection',
        'controller' => 'maps',
        'action' => [
            'GET' => 'showCollection',
            'POST' => 'getCoordinates'
        ],
    ],
];