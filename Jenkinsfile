pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                bat 'cd phpunit && composer install'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
                bat 'pwd'
                bat 'phpunit/vendor/bin/phpunit --version'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}