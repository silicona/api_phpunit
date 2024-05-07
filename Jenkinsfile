pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'php --version'
                sh 'phpunit --version'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}