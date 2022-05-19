resource "aws_ebs_snapshot" "safe" {
  volume_id = "vol-04a3fe45c5c411f2b"
  tags = {
    Name = "safe_snapshot"
  }
  provider = "aws.ohio"
}

resource "aws_ebs_snapshot" "euclid" {
  volume_id = "vol-0f818e9eb9cd98401"
  tags = {
    Name = "euclid_snapshot"
  }
  provider = "aws.ireland"
}

resource "aws_ebs_snapshot" "keter" {
  volume_id = "vol-0d278ffcb6b9af3bb"
  tags = {
    Name = "keter_snapshot"
  }
  provider = "aws.sydney"
}

resource "aws_ebs_snapshot" "blackjack" {
  volume_id = "vol-03975ffd2a120c7da"
  tags = {
    Name = "blackjack_snapshot"
  }
  provider = "aws.virginia"
}

resource "aws_ebs_snapshot" "hookers" {
  volume_id = "vol-08ebc0d54cb49db07"
  tags = {
    Name = "hookers_snapshot"
  }
  provider = "aws.california"
}

resource "aws_ebs_snapshot" "services" {
  volume_id = "vol-0a7a02bbfb2dc8ca7"
  tags = {
    Name = "services_snapshot"
  }
  provider = "aws.virginia"
}

resource "aws_ebs_snapshot" "tokyo" {
  volume_id = "vol-0731cc873f091fd6b"
  tags = {
    Name = "tokyo_snapshot"
  }
  provider = "aws.tokyo"
}
