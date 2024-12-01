// Pipeline usando o plugin Docker Pipeline.
pipeline {
    agent any

    environment {
        // dpp = Docker Pipeline Plugin
        CONTAINER_NAME = "appweb-dpp"
    }

    stages {
        stage("Build Image") {
            steps {
                script {
                    dockerImage = docker.build("harbor.dcwork.com.br/appweb-pipeline/${env.CONTAINER_NAME}:v${env.BUILD_ID}", "-f ${WORKSPACE}/Dockerfile ${WORKSPACE}/src")
                }
            }
        }

        stage("Push Docker Image") {
            steps {
                script {
                    docker.withRegistry("https://harbor.dcwork.com.br", "harbor_credential") {
                        dockerImage.push()
                    }
                }
            }
        }

        stage("Deploy Application") {
            steps {
                script {
                    docker.withRegistry("https://harbor.dcwork.com.br", "harbor_credential") {
                        def containerName = env.CONTAINER_NAME
                        def imageName = "harbor.dcwork.com.br/appweb-pipeline/${env.CONTAINER_NAME}:v${env.BUILD_ID}"

                        // Parar e remover o container existente (usando shell, porque o plugin não suporta isso diretamente)
                        try {
                            sh "docker rm -f ${containerName} || true"
                            echo "Container antigo '${containerName}' foi removido com sucesso."
                        } catch (Exception e) {
                            echo "Nenhum container antigo encontrado com o nome '${containerName}'."
                        }
                        // Executar o novo container
                        docker.image(imageName).run("-d -p 8081:80 --name ${containerName}")
                    }
                }
            }
        }
    }
}
