pipeline {
  agent any

  stages {
    stage("Construindo imagem Docker") {
      steps {
        sh 'echo "Executando o comando docker build..."'
      }
    }

    stage("Empurrando imagem Docker") {
      steps {
        sh 'echo "ExecEmpurrando a imagem Docker para o Registry..."'
      }
    }

    stage("Executando Deploy") {
      steps {
        sh 'echo "Executando o deployment da imagem..."'
      }
    }
  }
}
