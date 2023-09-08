# :bulb: Autentifikasi JWT Pada Laravel API

Repository ini berisi projek API yang menggunakan library passport untuk autentifikasi.

## :package: Prasyarat

Sebelum memulai, pastikan telah terinstall beberapa tools:
* Text editor
* Web browser
* Laravel 8
* MySQL

## :cd: Menginstall Aplikasi

Untuk menginstall aplikasi ini, ikuti langkah berikut:

```bash
# clone this repository
git clone https://github.com/kunkoder/laravel-api-passport.git

# change working directory
cd laravel-api-passport
```

>Note: jangan lupa untuk mengatur database sebelum menjalankan aplikasi.

## :trident: Route List
|  Method  |              URI              |
|----------|-------------------------------|
| post     | /api/register                 |
| post     | /api/login                    |
| post     | /api/superadmin               | 
| get      | /api/superadmin/{superadmin}  |
| get      | /api/superadmin               |
| patch    | /api/superadmin/{superadmin}  | 
| delete   | /api/superadmin/{superadmin}  |

## :eyes: Preview

**post `/api/register`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/register.png)

**post `/api/login`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/login.png)

**post `/api/superadmin`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/store.png)

**get `/api/superadmin/{superadmin}`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/show.png)

**get `/api/superadmin`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/showall.png)

**patch `/api/superadmin/{superadmin}`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/update.png)

**delete `/api/superadmin/{superadmin}`**
![alt text](https://raw.githubusercontent.com/kunkoder/laravel-api-passport/main/images/delete.png)
