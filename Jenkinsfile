pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                bat 'cd phpunit && composer install'
                bat 'cd codeception && composer install'
            }
        }
        stage('Test') {
            steps {
                bat 'cd phpunit && vendor\\bin\\phpunit --no-output'
                               
                bat 'cd codeception && composer run test'
                
                bat 'xcopy /Y codeception\\tests\\_output\\codeception_results.xml reports'
                
                junit 'reports\\*.xml'
            }
        }
    }
}