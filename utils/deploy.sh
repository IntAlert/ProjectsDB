#!/usr/bin/env bash


function eb_deploy() {

  # check git branch is correct
  GIT_BRANCH=$(git branch | sed -n -e 's/^\* \(.*\)/\1/p')

  


  # check git up to date
  if ! git diff-index --quiet HEAD --; then
    echo "git has untracked changes, aborting"
   exit 1
  fi
  echo "git is up to date"


  case $MODE in 
    "staging")

      # check correct branch
      if [ $GIT_BRANCH != "staging" ]; then
  	    echo 'Wrong branch';
  	    exit 1;
      fi

      echo "checking staging config file exists"
      if [ -f "beanstalk-environments/staging.config.yml" ]; then
		echo "copying config file for staging"
		`cp beanstalk-environments/staging.config.yml .elasticbeanstalk/config.yml`
		echo 'Deploying'
		eb deploy -v
      fi
      return 1
      ;;
    "production")

      # check correct branch
      if [ $GIT_BRANCH != "master" ]; then
  	    echo 'Wrong branch';
  	    exit 1;
      fi
      
      echo "checking production config file exists"
      if [ -f "beanstalk-environments/production.config.yml" ]; then
		echo "copying config file for production"
		`cp beanstalk-environments/production.config.yml .elasticbeanstalk/config.yml`
		echo 'Deploying'
		eb deploy -v
      fi
      return 1
      ;;
  esac
  return 0

}


MODE=$1
case $MODE in 
  "staging")
    echo "deploying to staging"
    eb_deploy
    ;;
  "production")
    echo "deploying to production"
    eb_deploy
    ;;
  *)
    echo "usage : $0 [staging|production]"
    exit 2;
    ;;
esac