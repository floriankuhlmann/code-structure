pipeline {
  agent none
  stages {
    stage('Docker Build') {
      agent any
      steps {
        git url: 'https://github.com/floriankuhlmann/code-structure'
        sh 'docker build .'
      }
    }
  }
}