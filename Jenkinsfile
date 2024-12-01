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
                    dockerImage = docker.build("harbor.dcwork.com.br/appweb-pipeline/appweb-jks:v${env.BUILD_ID}", "-f ${WORKSPACE}/Dockerfile ${WORKSPACE}/src")
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

                        // Parar e remover o container, se já existir
                        try {
                            def oldContainer = docker.container(${CONTAINER_NAME})
                            oldContainer.stop()
                            oldContainer.remove()
                        } catch (Exception e) {
                            echo "Nenhum container antigo encontrado com o nome ${CONTAINER_NAME}."
                        }

                        // Executar o novo container
                        def appContainer = docker.image("harbor.dcwork.com.br/appweb-pipeline/appweb-jks:v${env.BUILD_ID}")
                        appContainer.run("-d -p 9092:80 --name ${CONTAINER_NAME}")
                    }
                }
            }
        }
    }
}
