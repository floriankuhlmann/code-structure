pipeline {
    agent { label 'docker' }
    environment {
        // Specify your environment variables.
        APP_VERSION = '1'
        PATH = '/usr/local/bin'
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