import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import Item from "../components/Item";
import "./Home.css";

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
      .get("http://productpagematyss.x10.mx/api/getproducts")
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
          .post("http://productpagematyss.x10.mx/api/deleteproduct", {
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

  return (
    <div className="container">
      <div className="nav">
        <h1>Product List</h1>
        <div className="nav-btns">
          <Link to="/addproduct" className="nav-btn">ADD</Link>
          <button id="delete-product-btn" onClick={massDelete} className="nav-btn">MASS DELETE</button>
        </div>
      </div>
      <hr />
      <div className="content-container">
        <div className="item-container">
        {products && products.length > 0 ? (
            products.map((product) => (
              <Item
                key={product.sku}
                product={product}
                onChange={handleItemChange}
              />
            ))
          ) : null}

        </div>
      </div>
      <hr />
      <div className="footer">
        <p>Scandiweb Test assignment</p>
      </div>
    </div>
  );
}

export default Home;