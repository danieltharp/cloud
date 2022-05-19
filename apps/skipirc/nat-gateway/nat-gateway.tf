resource "aws_nat_gateway" "virginia" {
  subnet_id = "subnet-0fe48a641e328bb56"
}

resource "aws_nat_gateway" "california" {
  subnet_id = "subnet-07af25260e27a3dfd"
  provider = "aws.us_west_1"
}
