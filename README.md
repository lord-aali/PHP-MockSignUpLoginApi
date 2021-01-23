## The simple login and signup api based on php
#### A simple post api for test implementation (no sql needed)...
#### Features:
- Login
- Signup
- userdata
- simple control panel
---
### Test:
#### base url
```
http://zenta-apps.ir/api/login/test/v1/index.php
```
#### admin-panel
```
http://zenta-apps.ir/api/login/test/v1/admin-panel.php
```
    
---
### Signup
Request:
```
parameters:
    request_type -> signup : String Fixed
    username -> text : String *
    password -> text : String *
    name -> text : String *
    lastname -> text : String *
```
Response (if ok):
```
{
    "success": true,
    "is_app_active": false,
    "message": "key",
    "is_user_active": true,
    "body": {
        "username": "Simple name",
        "password": "1234",
        "name": "John",
        "lastname": "Smith",
        "avatar": "https://sample.com/avatar.jpg",
        "key": "UPAtXe2RbSOad9AxrXCIvFGO48xWWaX0"
    }
}
```
Response (if fail):
```
{
    "success": false,
    "is_app_active": false,
    "message": "User already exists. Try to login.",
    "body": null
}
```

---
### Login
Request (username/password):
```
parameters:
    request_type -> login : String Fixed
    username -> text : String *
    password -> text : String *
```
Response (if ok):
```
{
    "success": true,
    "is_app_active": false,
    "message": "key",
    "is_user_active": true,
    "body": {
        "key": "UPAtXe2RbSOad9AxrXCIvFGO48xWWaX0"
    }
}
```
Response (if fail):
```
{
    "success": false,
    "is_app_active": false,
    "message": "wrong username/password",
    "body": null
}
```
Request (key):
```
parameters:
    request_type -> login : String Fixed
    username -> text : String *
    password -> text : String *
```
Response (if ok):
```
{
    "success": true,
    "is_app_active": false,
    "message": "success",
    "body": null
}
```
Response (if fail):
```
{
    "success": false,
    "is_app_active": false,
    "message": "User not found.",
    "body": null
}
```
---
### Get Registered User
Request (key):
```
parameters:
    request_type -> user_data : String Fixed
    key -> text : String * (length: 32)
```
Response (if ok):
```
{
    "success": true,
    "is_app_active": false,
    "message": "key",
    "is_user_active": true,
    "body": {
        "username": "Simple name",
        "name": "John",
        "lastname": "Smith",
        "avatar": "https://sample.com/avatar.jpg"
    }
}
```
Response (if fail):
```
{
    "success": false,
    "is_app_active": false,
    "message": "User not found.",
    "body": null
}
```