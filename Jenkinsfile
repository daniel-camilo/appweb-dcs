pipeline {
    agent any

    environment {
        CONTAINER_NAME = "appweb"
    }

    stages {
        stage("Construindo a imagem...") {
            steps {
                script {
                    sh "docker build -t ${env.CONTAINER_NAME}:${env.BUILD_ID} -f Dockerfile src"
                }
            }
        }

        stage("Encerrando container pré existente...") {
            steps {
                script {
                    // Verifica se o conatiner está em execução e o remove:
                    sh """
                    if [ \$(docker ps -aq -f name=${CONTAINER_NAME}) ]; then
                        docker stop ${CONTAINER_NAME} || true
                        docker rm ${CONTAINER_NAME} || true
                    fi
                    """
                }
            }
        }

        stage("Implantando o container...") {
            steps {
                script {
                    sh """
                    docker run -d --name ${CONTAINER_NAME} -p 8081:80 ${env.CONTAINER_NAME}:${env.BUILD_ID}
                    """
                }
            }
        }
    }
}
