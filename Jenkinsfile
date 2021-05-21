pipeline {
    agent any

    stages {
        stage('Hello') {
            steps {
                echo 'Hello World'
            }
        }
        stage('Composer Install') {
            steps {
                sh 'composer install'
            }
        }
    }
}