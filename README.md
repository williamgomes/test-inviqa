<p align="center">The Burrough Test</p>
<p align="center">
<a href="https://travis-ci.org/williamgomes/test-inviqa"><img src="https://travis-ci.org/williamgomes/test-inviqa.svg?branch=master" alt="Build Status"></a>
<p align="center">===========================</p>

## Installation

### Clone project

Use following procedure to complete setup of this project.


1. Clone the project if you don't have already.

```
git clone https://github.com/williamgomes/test-inviqa.git
```

2. Download composer if you didn't have.


```
curl -sS https://getcomposer.org/installer | php
```

3. Install all the packages required to run this application by running following command.

```
php composer.phar install
```

4. Define the year for which you want to generate report in config.yml file.

```
financial_year: 2017  # <= for which year the system has to generate the output
```

5. In order to generate report use below command.

```
php index.php payday:generate {filename}
```

6. This will create two individual report for salary and bonus.



### Testing

To run the test properly, please run below command from commandline.

```
php vendor/bin/phpunit --colors --coverage-text --configuration tests/phpunit.xml.dist  tests/
```