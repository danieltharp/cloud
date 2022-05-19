terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 3.0"
    }
  }
}

provider "aws" {
  region = "us-east-1"
}

provider "aws" {
  alias           = "virginia"
  region          = "us-east-1"
}

provider "aws" {
  alias           = "california"
  region          = "us-west-1"
}

provider "aws" {
  alias           = "ohio"
  region          = "us-east-2"
}

provider "aws" {
  alias           = "ireland"
  region          = "eu-west-1"
}

provider "aws" {
  alias           = "sydney"
  region          = "ap-southeast-2"
}

provider "aws" {
  alias           = "tokyo"
  region          = "ap-northeast-1"
}
