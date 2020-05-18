<p align="left">Template</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Template

# php/composer already installed

# git clone
git clone https://repo.dev.jacos.jp/gitbucket/git/y_sakaki/template.git

composer install

# make .env
cp .env.example .env
# edit .env
# database info

composer update

php artisan key:generate

php artisan migrate

php artisan db:seed


### About Testcafe

#Ensure that Node.js and npm are installed on your computer and run the following command:

## For Running the Test

#You can run the test from a command shell by calling a single command where you specify the target browser and file path.

testcafe chrome test.js

N.B: TestCafe automatically opens the chosen browser and starts test execution within it.

##Test Speed

#TestCafe provides the capability to change test speed. 

testcafe chrome test.js --speed 0.1

#testcafe function check Example 

test('Check the page URL', async t => {
    await t
        Function code here 
});

#Testcafe select function checking 
testcafe chrome test.js -t "My Login"
# crmapplication
