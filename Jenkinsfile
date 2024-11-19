pipeline {
    agent any

    stages {
        stage("Build Image") {
            steps {
                sshagent(['jenkins-docker']) { // ID da credencial SSH configurada no Jenkins
                    sh """
                    ssh jenkins@10.108.0.2 'docker build -t harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID} -f ./Dockerfile ./src'
                    """
                }
            }
        }

        stage("Push Docker Image") {
            steps {
                sshagent(['jenkins-docker']) { // ID da credencial SSH configurada no Jenkins
                    sh """
                    ssh jenkins@10.108.0.2 'docker login harbor.dcwork.com.br --username username --password password && docker push harbor.dcwork.com.br/appweb-pipeline/appweb-jks:${env.BUILD_ID}'
                    """
                }
            }
        }
    }
}


/* pipeline {
  agent any

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
} */

// harbor_credential
