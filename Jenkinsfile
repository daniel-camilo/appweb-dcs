pipeline {
    agent any
    
    environment {
        REMOTE_WSPACE = "/root/docker-projects/jenkins/jenkins_data/workspace/${env.JOB_NAME}"
    }

    stages {
        stage('Exibir Informações do Pipeline') {
            steps {
                script {
                    echo "Workspace remoto do Pipeline: ${env.REMOTE_WSPACE}"
                }
            }
        }
    }
}
