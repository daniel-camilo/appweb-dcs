pipeline {
  agent any

  stages {
    stage("Construindo imagem Docker") {
      step {
        sh 'echo "Executando o comando docker build..."'
      }
    }

    stage("Empurrando imagem Docker") {
      step {
        sh 'echo "ExecEmpurrando a imagem Docker para o Registry..."'
      }
    }

    stage("Executando Deploy") {
      step {
        sh 'echo "Executando o deployment da imagem..."'
      }
    }
  }
}
