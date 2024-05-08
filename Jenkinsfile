pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                bat 'cd phpunit && composer install'
            }
        }
        stage('Test') {
            steps {
                bat 'cd phpunit && vendor\\bin\\phpunit'
                junit 'phpunit\\reports\\*.xml'
            }
        }
    }
}