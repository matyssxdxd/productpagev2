import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import Item from "../components/Item";

export interface Product {
  sku: string;
  name: string;
  price: number;
  type: string;
  size: number | null;
  weight: number | null;
  height: number | null;
  width: number | null;
  length: number | null;
}

function Home() {
  const [products, setProducts] = useState<Product[]>([]);
  const [selected, setSelected] = useState<string[]>([]);

  useEffect(() => {
    getProducts();
  }, []);

  const handleItemChange = (itemId: string, isChecked: boolean) => {
    if (isChecked) {
      setSelected([...selected, itemId]);
    } else {
      setSelected(selected.filter((id) => id !== itemId));
    }
  };

  const getProducts = () => {
    axios
      .get("http://127.0.0.1:8989/api/getproducts")
      .then((response) => {
        setProducts(response.data);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const massDelete = () => {
    if (selected.length !== 0) {
      selected.forEach((id) => {
        axios
          .post("http://127.0.0.1:8989/api/deleteproduct", {
            sku: id,
          })
          .then((response) => {
            console.log(response.data);
            setSelected((current) => current.filter((sku) => sku !== id));
            getProducts();
          });
      });
    }
  };

  // const removeSecond = () => {
  //   setFruits((current) =>
  //     current.filter((fruit) => fruit.id !== 2)
  //   );
  // };

  return (
    <>
      <div className="nav">
        <h1>Product List</h1>
        <div className="nav-btn">
          <Link to="/addproduct">ADD</Link>
          <button onClick={massDelete}>MASS DELETE</button>
        </div>
      </div>
      <div className="item-container">
        {products.map((product) => (
          <Item
            key={product.sku}
            product={product}
            onChange={handleItemChange}
          />
        ))}
      </div>
    </>
  );
}

export default Home;
