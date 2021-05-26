pipeline {
    agent {
        docker { image 'php:7.4-cli' }
    }
    environment {
        // Specify your environment variables.
        APP_VERSION = '1'
    }
    stages {
        stage('Hello') {
             steps {
                echo 'Hello World'
             }
        }
        stage('build') {
            steps {
                echo 'docker build'
                sh 'docker build .'
            }
        }
        stage('post') {
            steps {
                echo 'delete dir'
                deleteDir()
            }
        }
    }
}