pipeline {
  agent {
    docker {
      image 'docker:latest'
      args '--privileged -v /var/run/docker.sock:/var/run/docker.sock'
    }
  }

  stages {
    stage("Build Image") {
      steps {
        script{
          dockerapp = docker.build("harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}", '-f ./Dockerfile ./src')
        }
      }
    }

    stage("Empurrando imagem Docker") {
      steps {
        script {
          docker.withRegistry('https://harbor.dcwork.com.br', 'harbor_credential') {
            dockerapp.push()
          }
        }
      }
    }
  }
}

// harbor_credential
