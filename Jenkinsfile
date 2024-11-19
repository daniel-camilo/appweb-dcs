pipeline{
  agent any

  stages {
    stage('Verificar Repositório Git') {
        steps {
            script {
                sh 'pwd'  // Exibe o diretório atual
                sh 'ls -l'  // Lista os arquivos do diretório atual
                sh 'git status'  // Verifica o status do repositório Git
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
