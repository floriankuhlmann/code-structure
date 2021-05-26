pipeline {
    agent {
        docker { image 'php:7.4-cli' }
    }
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
                docker.build("codestructure","-f ./Dockerfile .")
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